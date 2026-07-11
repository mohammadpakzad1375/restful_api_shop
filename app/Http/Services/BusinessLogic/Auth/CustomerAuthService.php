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

            return $this->otpService->send($inputs['email']);

        });
    }

    public function verifyOtp($inputs): ServiceResult
    {
        return app(TransactionalServiceWrapper::class)(function () use($inputs) {

            $verifyResult = $this->otpService->verify($inputs['email'], $inputs['otp']);

            if (!$verifyResult['success'])
                return $verifyResult;

            $user = User::firstOrCreate([
                'email' => $inputs['email'],
            ]);

            $accessToken = JWTAuth::fromUser($user);

            $refreshToken = $this->refreshTokenService->create(
                $user,
                request()->ip(),
                request()->userAgent()
            );

            return [
                'success' => true,
                'message' => 'User verified successfully.',
                'data' => [
                    'access_token' => $accessToken,
                    'refresh_token' => $refreshToken['plain_text_token'],
                    'token_type' => 'Bearer',
                    'expires_in' => auth('customer')->factory()->getTTL() * 60,
                ]
            ];

        });
    }

    public function refresh($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($inputs) {



        });
    }

    public function logout($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($inputs) {



        });
    }

    public function logoutAllDevices(): ServiceResult
    {
        return app(ServiceWrapper::class)(function () {



        });
    }
}
