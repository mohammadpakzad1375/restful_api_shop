<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\Content\Post;
use App\Models\Market\Delivery;

class DeliveryService
{
    public function showAllDeliveries(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Delivery::orderBy('created_at','desc')->get();

        });
    }

    public function createDelivery($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            return Delivery::create($inputs);

        });
    }

    public function updateDelivery($inputs, Delivery $delivery): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $delivery){

            $delivery->update($inputs);
            return $delivery;

        });
    }

    public function deleteDelivery(Delivery $delivery): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($delivery){

            $delivery->delete();

        });
    }
}
