<?php

namespace App\Http\Controllers\Api\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Customer\Auth\RefreshApiRequest;
use App\Http\Requests\ApiRequests\Customer\Auth\SendOtpApiRequest;
use App\Http\Requests\ApiRequests\Customer\Auth\VerifyOtpApiRequest;
use App\Http\Services\BusinessLogic\Auth\CustomerAuthService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Http\Services\RestfulApi\ApiResponse\ApiResponse as ApiResponseService;
use Illuminate\Http\Request;

class CustomerAuthController extends Controller
{
    private CustomerAuthService $customerAuthService;
    private ApiResponseService $apiResponse;

    public function __construct(CustomerAuthService $customerAuthService, ApiResponseService $apiResponse)
    {
        $this->customerAuthService = $customerAuthService;
        $this->apiResponse = $apiResponse;
    }

    public function sendOtp(SendOtpApiRequest $request)
    {
        $result = $this->customerAuthService->sendOtp($request->validated());

        return ApiResponse::withResponseMessage('OTP sent successfully.')
            ->build()
            ->response($result->success);
    }

    public function verifyOtp(VerifyOtpApiRequest $request)
    {
        $result = $this->customerAuthService->verifyOtp($request->validated());

        if (!$result->data['success']) {

            $this->apiResponse->setSuccess($result->data['success']);
            $this->apiResponse->setResponseStatus(400);

        } else {
            $this->apiResponse->setData($result->data['data']);
        }

        $this->apiResponse->setResponseMessage($result->data['message']);

        return $this->apiResponse->response($result->success);
    }

    public function refresh(RefreshApiRequest $request)
    {
        $result = $this->customerAuthService->refresh($request->validated());

        if (!$result->data['success']) {

            $this->apiResponse->setSuccess($result->data['success']);
            $this->apiResponse->setResponseStatus(401);

        } else {
            $this->apiResponse->setData($result->data['data']);
        }

        $this->apiResponse->setResponseMessage($result->data['message']);

        return $this->apiResponse->response($result->success);
    }

    public function logout(RefreshApiRequest $request)
    {
        $result = $this->customerAuthService->logout($request->validated());

        return ApiResponse::withResponseMessage('Successfully logged out.')
            ->build()
            ->response($result->success);
    }

    public function logoutAllDevices(Request $request)
    {

    }
}
