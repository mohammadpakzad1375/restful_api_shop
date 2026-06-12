<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Market\Delivery\DeliveryStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Market\Delivery\DeliveryUpdateApiRequest;
use App\Http\Resources\Market\Delivery\DeliveryApiResource;
use App\Http\Resources\Market\Delivery\DeliveryApiResourceCollection;
use App\Http\Services\BusinessLogic\Market\DeliveryService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function __construct(private DeliveryService $deliveryService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->deliveryService->showAllDeliveries();

        return ApiResponse::withData(DeliveryApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryStoreApiRequest $request)
    {
        $result = $this->deliveryService->createDelivery($request->validated());

        return ApiResponse::withResponseMessage('Delivery created successfully.')
            ->withData(DeliveryApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        return ApiResponse::withData(DeliveryApiResource::make($delivery))
            ->build()
            ->response((bool) $delivery);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeliveryUpdateApiRequest $request, Delivery $delivery)
    {
        $result = $this->deliveryService->updateDelivery($request->validated(), $delivery);

        return ApiResponse::withResponseMessage('Delivery updated successfully.')
            ->withData(DeliveryApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        $result = $this->deliveryService->deleteDelivery($delivery);

        return ApiResponse::withResponseMessage('Delivery deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
