<?php

namespace App\Http\Services\BusinessLogic\Auth;

use App\Http\Services\Auth\OtpService;
use App\Http\Services\Auth\RefreshTokenService;
use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\BusinessLogic\Tools\TransactionalServiceWrapper;
use App\Models\User\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomerAuthService
{
    private RefreshTokenService $refreshTokenService;
    private OtpService $otpService;

    public function __construct(RefreshTokenService $refreshTokenService, OtpService $otpService)
    {
        $this->refreshTokenService = $refreshTokenService;
        $this->otpService = $otpService;
    }

    public function sendOtp($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($inputs) {

            $this->otpService->send($inputs['email']);

        });
    }

    public function verifyOtp($inputs): ServiceResult
    {
        return app(TransactionalServiceWrapper::class)(function () use($inputs) {

            $verifyResult = $this->otpService->verify($inputs['email'], $inputs['otp']);

            if (!$verifyResult['success'])
                return $verifyResult;

            $user = User::where('email', $inputs['email'])->first();

            if ($user)
            {
                if ($user->isAdmin())
                {
                    return [
                        'success' => false,
                        'message' => 'This action is unauthorized.',
                        'status' => 403
                    ];
                }
            } else {

                $user = User::create([
                    'email' => $inputs['email'],
                ]);
            }

            $accessToken = JWTAuth::fromUser($user);

            $refreshToken = $this->refreshTokenService->create(
                $user,
                request()->ip(),
                request()->userAgent()
            );

            return [
                'success' => true,
                'message' => 'User verified successfully.',
                'status' => 200,
                'data' => [
                    'access_token' => $accessToken,
                    'refresh_token' => $refreshToken['plain_text_token'],
                    'token_type' => 'Bearer',
                    'expires_in' => auth('customer')->factory()->getTTL() * 60,
                ]
            ];

        });
    }

    //Refresh Access Token
    public function refresh($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($inputs) {

            $rotateResult = $this->refreshTokenService
                ->rotate($inputs['refresh_token']);

            if (is_string($rotateResult))
                return [
                    'success' => false,
                    'message' => $rotateResult
                ];

            $accessToken = JWTAuth::fromUser($rotateResult['model']->user);

            return [
                'success' => true,
                'message' => 'Token refreshed successfully.',
                'data' => [
                    'access_token' => $accessToken,
                    'refresh_token' => $rotateResult['plain_text_token'],
                    'token_type' => 'Bearer',
                    'expires_in' => auth('customer')->factory()->getTTL() * 60,
                ]
            ];

        });
    }

    public function logout($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($inputs) {

            $refreshToken = $this->refreshTokenService->findValid($inputs['refresh_token']);

            if ($refreshToken)
            {
                $this->refreshTokenService->revokeForUser($refreshToken);

                //Revoke access token
                auth('customer')->logout();
            }

        });
    }

    public function logoutAllDevices(): ServiceResult
    {
        return app(ServiceWrapper::class)(function () {

            $user = auth('customer')->user();

            $this->refreshTokenService->revokeAll($user);

            auth('customer')->logout();

        });
    }
}
