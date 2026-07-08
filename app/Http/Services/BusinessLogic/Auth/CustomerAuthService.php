<?php

namespace App\Http\Services\BusinessLogic\Auth;

use App\Events\Admin\Auth\Login;
use App\Http\Services\Auth\RefreshTokenService;
use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\BusinessLogic\Tools\TransactionalServiceWrapper;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class CustomerAuthService
{
    public function __construct(private RefreshTokenService $refreshTokenService)
    {
    }

    public function sendOtp($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($inputs) {



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
