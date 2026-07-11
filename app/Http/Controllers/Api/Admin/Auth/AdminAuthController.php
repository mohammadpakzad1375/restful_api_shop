<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Auth\ChangePasswordRequest;
use App\Http\Requests\ApiRequests\Admin\Auth\LoginApiRequest;
use App\Http\Resources\User\Admin\AdminApiResource;
use App\Http\Services\BusinessLogic\Auth\AdminAuthService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use Illuminate\Http\Request;


class AdminAuthController extends Controller
{
    public function __construct(private AdminAuthService $adminAuthService)
    {
    }

    public function login(LoginApiRequest $request, \App\Http\Services\RestfulApi\ApiResponse\ApiResponse $apiResponse)
    {
        $result = $this->adminAuthService->login($request->validated());

        if (is_array($result->data))
        {
            $apiResponse->setResponseMessage('Successfully logged in.');
            $apiResponse->setData(AdminApiResource::make($result->data['admin']));
            $apiResponse->setAppends(['token' => $result->data['token']]);
        } else {

            $apiResponse->setSuccess(false);
            $apiResponse->setResponseMessage($result->data);
            $apiResponse->setResponseStatus(401);
        }

        return $apiResponse->response($result->success);

    }

    public function logout(Request $request)
    {
        $result = $this->adminAuthService->logout($request->user());

        return ApiResponse::withResponseMessage('Successfully logged out.')
            ->build()
            ->response($result->success);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $result = $this->adminAuthService->changePassword($request->user(), $request->validated());

        return ApiResponse::withResponseMessage('Password changed successfully.')
            ->build()
            ->response($result->success);
    }
}
