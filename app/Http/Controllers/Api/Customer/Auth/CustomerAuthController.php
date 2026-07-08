<?php

namespace App\Http\Controllers\Api\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Customer\Auth\RefreshApiRequest;
use App\Http\Requests\ApiRequests\Customer\Auth\SendOtpApiRequest;
use App\Http\Requests\ApiRequests\Customer\Auth\VerifyOtpApiRequest;
use App\Http\Services\BusinessLogic\Auth\CustomerAuthService;
use Illuminate\Http\Request;

class CustomerAuthController extends Controller
{
    public function __construct(private CustomerAuthService $customerAuthService)
    {
    }

    public function sendOtp(SendOtpApiRequest $request)
    {

    }

    public function verifyOtp(VerifyOtpApiRequest $request)
    {

    }

    public function refresh(RefreshApiRequest $request)
    {

    }

    public function logout(RefreshApiRequest $request)
    {

    }

    public function logoutAllDevices(Request $request)
    {

    }
}
