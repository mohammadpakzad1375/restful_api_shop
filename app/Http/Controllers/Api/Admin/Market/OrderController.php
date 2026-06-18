<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Market\Order\ChangeOrderDeliveryStatusApiRequest;
use App\Http\Requests\ApiRequests\Admin\Market\Order\ChangeOrderPaymentStatusApiRequest;
use App\Http\Requests\ApiRequests\Admin\Market\Order\ChangeOrderStatusApiRequest;
use App\Http\Resources\Market\Order\OrderApiResource;
use App\Http\Resources\Market\Order\OrderApiResourceCollection;
use App\Http\Services\BusinessLogic\Market\OrderService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Mail\Admin\Market\Order\OrderPaymentStatusMail;
use App\Models\Market\Order;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        return new OrderPaymentStatusMail(Order::find(1));

//        $result = $this->orderService->showAllOrders();
//
//        return ApiResponse::withData(OrderApiResourceCollection::make($result->data))
//            ->build()
//            ->response($result->success);
    }

    public function newOrder()
    {
        $result = $this->orderService->showNewOrders();

        return ApiResponse::withData(OrderApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function awaitingConfirmation()
    {
        $result = $this->orderService->showAwaitingConfirmationOrders();

        return ApiResponse::withData(OrderApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function unpaid()
    {
        $result = $this->orderService->showUnpaidOrders();

        return ApiResponse::withData(OrderApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function canceled()
    {
        $result = $this->orderService->showCanceledOrders();

        return ApiResponse::withData(OrderApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function returned()
    {
        $result = $this->orderService->showCanceledOrders();

        return ApiResponse::withData(OrderApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function show(Order $order)
    {
        $result = $this->orderService->showOrder($order);

        return ApiResponse::withData(OrderApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function changeDeliveryStatus(ChangeOrderDeliveryStatusApiRequest $request, Order $order)
    {
        $result = $this->orderService->changeDeliveryStatus($request->validated(), $order);

        return ApiResponse::withResponseMessage("Order delivery status changed successfully. status = {$result->data}")
            ->build()
            ->response($result->success);
    }

    public function changeOrderStatus(ChangeOrderStatusApiRequest $request, Order $order)
    {
        $result = $this->orderService->changeOrderStatus($request->validated(), $order);

        return ApiResponse::withResponseMessage("Order status changed successfully. status = {$result->data}")
            ->build()
            ->response($result->success);
    }

    public function changePaymentStatus(ChangeOrderPaymentStatusApiRequest $request, Order $order)
    {
        $result = $this->orderService->changePaymentStatus($request->validated(), $order);

        return ApiResponse::withResponseMessage("Order payment status changed successfully. {$result->data}")
            ->withRejectMessage($result->data)
            ->build()
            ->response($result->success);
    }
}
