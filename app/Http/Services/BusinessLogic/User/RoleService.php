<?php

namespace App\Http\Services\BusinessLogic\User;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\User\Role;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class RoleService
{
    public function showAllRoles(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Role::with('permissions')->orderBy('created_at','desc')->get();

        });
    }

    public function createRole($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $role = Role::create($inputs);

            isset($inputs['permissions']) && $role->permissions()->sync($inputs['permissions']);

            return $role->refresh();

        });
    }

    public function showRole(Role $role): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($role){

            return  $role->load(['permissions', 'users']);

        });
    }

    public function updateRole($inputs, Role $role): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $role){

            isset($inputs['permissions']) && $role->permissions()->sync($inputs['permissions']);

            $role->update($inputs);
            return $role->refresh()->load('permissions');

        });
    }

    public function deleteRole(Role $role): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($role){

            $role->delete();

        });
    }
}
