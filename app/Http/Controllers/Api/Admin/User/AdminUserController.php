<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\User\Admin\AdminStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\User\Admin\AdminUpdateApiRequest;
use App\Http\Resources\User\Admin\AdminApiResource;
use App\Http\Resources\User\Admin\AdminApiResourceCollection;
use App\Http\Services\BusinessLogic\User\AdminUserService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\User\User;

class AdminUserController extends Controller
{
    public function __construct(private AdminUserService $adminUserService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->adminUserService->showAllAdmins();

        return ApiResponse::withData(AdminApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreApiRequest $request)
    {
        $result = $this->adminUserService->createAdmin($request->validated());

        return ApiResponse::withResponseMessage('Admin created successfully.')
            ->withData(AdminApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $adminUser)
    {
        return ApiResponse::withData(AdminApiResource::make($adminUser))
            ->build()
            ->response((bool) $adminUser);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateApiRequest $request, User $adminUser)
    {
        $result = $this->adminUserService->updateAdmin($request->validated(), $adminUser);

        return ApiResponse::withResponseMessage('Admin updated successfully.')
            ->withData(AdminApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $adminUser)
    {
        $result = $this->adminUserService->deleteAdmin($adminUser);

        return ApiResponse::withResponseMessage('Admin deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
