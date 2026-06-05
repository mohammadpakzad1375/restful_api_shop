<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\Market\CashPayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Payment;
use App\Models\Market\Product;

class PaymentService
{
    public function showAllPayments(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Payment::with(['paymentable', 'user'])->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function showOnlinePayments(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Payment::where('paymentable_type', OnlinePayment::class)->with(['paymentable', 'user'])->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function showCashPayments(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Payment::where('paymentable_type', CashPayment::class)->with(['paymentable', 'user'])->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function showPayment(Payment $payment): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($payment) {

            return $payment->load(['paymentable', 'user']);

        });
    }

    public function cancelPayment(Payment $payment): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($payment) {

            $payment->status = 2;
            return $payment->save();

        });
    }

    public function returnPayment(Payment $payment): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($payment) {

            $payment->status = 3;
            return $payment->save();

        });
    }
}
