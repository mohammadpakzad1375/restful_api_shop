<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Auth\ChangePasswordRequest;
use App\Http\Services\BusinessLogic\Auth\AdminPasswordService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;

class AdminPasswordController extends Controller
{
    public function __construct(private AdminPasswordService $adminPasswordService)
    {
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $result = $this->adminPasswordService->changePassword($request->user(), $request->validated());

        return ApiResponse::withResponseMessage($result->data)
            ->build()
            ->response($result->success);
    }
}
