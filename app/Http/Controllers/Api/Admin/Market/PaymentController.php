<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Resources\Market\Payment\PaymentApiResource;
use App\Http\Resources\Market\Payment\PaymentApiResourceCollection;
use App\Http\Services\BusinessLogic\Market\PaymentService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $paymentService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        $result = $this->paymentService->showAllPayments();

        return ApiResponse::withData(PaymentApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function online()
    {
        $result = $this->paymentService->showOnlinePayments();

        return ApiResponse::withData(PaymentApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function cash()
    {
        $result = $this->paymentService->showCashPayments();

        return ApiResponse::withData(PaymentApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function show(Payment $payment)
    {
        $result = $this->paymentService->showPayment($payment);

        return ApiResponse::withData(PaymentApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function cancel(Payment $payment)
    {
        $result = $this->paymentService->cancelPayment($payment);

        return ApiResponse::withResponseMessage("Payment canceled successfully")
            ->build()
            ->response($result->success);
    }

    public function return(Payment $payment)
    {
        $result = $this->paymentService->returnPayment($payment);

        return ApiResponse::withResponseMessage("Payment returned successfully")
            ->build()
            ->response($result->success);
    }
}
