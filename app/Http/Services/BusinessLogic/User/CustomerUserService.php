<?php

namespace App\Http\Services\BusinessLogic\User;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class CustomerUserService
{
    public function showAllCustomers(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return User::customer()->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function createCustomer($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $inputs['profile_photo_path'] = ImageService::save($inputs['profile_photo_path'], 'customer');

            $inputs['user_type'] = 0;
            $inputs['password'] = Hash::make($inputs['password']);

            $customer = User::create($inputs);

            return $customer->refresh();

        });
    }

    public function updateCustomer($inputs, User $customer): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $customer){

            if (array_key_exists('profile_photo_path', $inputs))
            {
                ImageService::deleteImage($customer->profile_photo_path);
                $inputs['profile_photo_path'] = ImageService::save($inputs['profile_photo_path'], 'customer');
            }

            if (array_key_exists('password', $inputs))
                $inputs['password'] = Hash::make($inputs['password']);

            $customer->update($inputs);
            return $customer->refresh();

        });
    }

    public function deleteCustomer(User $customer): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($customer){

            $customer->delete();

        });
    }
}
