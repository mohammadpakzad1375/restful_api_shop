<?php

namespace App\Http\Services\BusinessLogic\User;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class AdminUserService
{
    public function showAllAdmins(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return User::admin()->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function createAdmin($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $inputs['profile_photo_path'] = ImageService::save($inputs['profile_photo_path'], 'admin');

            $inputs['user_type'] = 1;
            $inputs['password'] = Hash::make($inputs['password']);

            return User::create($inputs);

        });
    }

    public function updateAdmin($inputs, User $adminUser): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $adminUser){

            if (array_key_exists('profile_photo_path', $inputs))
            {
                ImageService::deleteImage($adminUser->profile_photo_path);
                $inputs['profile_photo_path'] = ImageService::save($inputs['profile_photo_path'], 'admin');
            }

            if (array_key_exists('password', $inputs))
                $inputs['password'] = Hash::make($inputs['password']);

            $adminUser->update($inputs);
            return $adminUser;

        });
    }

    public function deleteAdmin(User $adminUser): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($adminUser){

            $adminUser->delete();

        });
    }
}
