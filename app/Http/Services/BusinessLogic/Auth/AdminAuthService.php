<?php

namespace App\Http\Services\BusinessLogic\Auth;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class AdminAuthService
{
    public function login($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($inputs) {

            $admin = User::where('email', $inputs['email'])->first();

            if (! $admin or !$admin->isAdmin() or ! Hash::check($inputs['password'], $admin->password)) {

                return 'Invalid credentials';
            }

            $token = $admin->createToken('admin-login')->plainTextToken;

            return [
                'token' => $token,
                'admin' => $admin
            ];

        });
    }

    public function logout(User $admin)
    {
        return app(ServiceWrapper::class)(function () use($admin) {

            $admin->currentAccessToken()->delete();

            return 'Successfully logged out.';

        });
    }
}
