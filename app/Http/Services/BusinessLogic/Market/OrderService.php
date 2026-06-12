<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Market\Order;

class OrderService
{
    public function showAllOrders(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Order::orderBy('created_at','desc')->paginate(10);

        });
    }

    public function showNewOrders(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Order::where('order_status', 0)->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function showAwaitingConfirmationOrders(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Order::where('order_status', 1)->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function showUnpaidOrders(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Order::where('payment_status', 0)->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function showCanceledOrders(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Order::where('order_status', 4)->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function showReturnedOrders(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Order::where('order_status', 5)->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function showOrder(Order $order): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($order) {

            return $order
                ->load([
                    'user',
                    'payment',
                    'payment.paymentable',
                    'delivery',
                    'copan',
                    'commonDiscount',
                ]);

        });
    }

    public function changeDeliveryStatus($inputs, Order $order): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($inputs, $order) {

            $order->delivery_status = $inputs['status'];
            $order->save();

            return $order->refresh()->delivery_status;

        });
    }

    public function changeOrderStatus($inputs, Order $order): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($inputs, $order) {

            $order->order_status = $inputs['status'];
            $order->save();

            return $order->refresh()->order_status;

        });
    }

    public function changePaymentStatus($inputs, Order $order): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use($inputs, $order) {

            $order->payment->update([
                'status' => $inputs['status'],
            ]);

            return $order->refresh()->payment->status;

        });
    }
}
