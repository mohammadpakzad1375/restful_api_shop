<?php

namespace App\Http\Services\BusinessLogic\Auth;

use App\Events\Admin\Auth\Login;
use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class AdminPasswordService
{
    public function changePassword(User $admin, $inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($admin, $inputs) {

            $admin->update([
                'password' => Hash::make($inputs['password'])
            ]);

            $admin->tokens()->delete();

            return 'Password changed successfully.';

        });
    }
}
