<?php

namespace App\Http\Services\BusinessLogic\Auth;

use App\Events\Customer\Auth\SendOtp;
use App\Http\Services\Auth\OtpService;
use App\Http\Services\Auth\RefreshTokenService;
use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\BusinessLogic\Tools\TransactionalServiceWrapper;
use App\Models\Auth\OtpCode;

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

            $otp = $this->otpService->generateOtpCode();

            OtpCode::updateOrCreate(
                [
                    'email' => $inputs['email'],
                ],
                [
                    'code' => $this->otpService->hashOtpCode($otp),
                    'expires_at' => now()->addMinutes(2),
                    'used_at' => null,
                ]
            );

            SendOtp::dispatch($otp, $inputs['email']);

        });
    }

    public function verifyOtp($inputs): ServiceResult
    {
        return app(TransactionalServiceWrapper::class)(function () use($inputs) {



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
