<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\User\Role\RoleStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\User\Role\RoleUpdateApiRequest;
use App\Http\Resources\User\Role\RoleApiResource;
use App\Http\Resources\User\Role\RoleApiResourceCollection;
use App\Http\Services\BusinessLogic\User\RoleService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\User\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(private RoleService $roleService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->roleService->showAllRoles();

        return ApiResponse::withData(RoleApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreApiRequest $request)
    {
        $result = $this->roleService->createRole($request->validated());

        return ApiResponse::withResponseMessage('Role created successfully.')
            ->withResponseStatus(201)
            ->withData(RoleApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $result = $this->roleService->showRole($role);

        return ApiResponse::withData(RoleApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateApiRequest $request, Role $role)
    {
        $result = $this->roleService->updateRole($request->validated(), $role);

        return ApiResponse::withResponseMessage('Role updated successfully.')
            ->withData(RoleApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $result = $this->roleService->deleteRole($role);

        return ApiResponse::withResponseMessage('Role deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
