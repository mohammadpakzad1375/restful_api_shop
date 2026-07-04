<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Log;

class StorageService
{

    public function addProductToStorage($inputs, Product $product): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $product){

            $product->marketable_number += $inputs['marketable_number'];
            $product->save();

            Log::channel('storage_log')->info('Marketable info', [
                'receiver' => $inputs['receiver'],
                'deliverer' => $inputs['deliverer'],
                'add' => $inputs['marketable_number'],
                'description' => $inputs['description'] ?? null,
            ]);

            return $product;

        });
    }

    public function updateProductInventory($inputs, Product $product): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $product) {

            $product->update($inputs);
           return $product;

        });
    }
}
