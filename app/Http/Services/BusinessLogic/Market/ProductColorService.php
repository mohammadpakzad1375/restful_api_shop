<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;

class ProductColorService
{
    public function showAllProductColors(Product $product): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($product){

            return $product->colors;

        });
    }

    public function createProductColors($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            return ProductColor::create($inputs);

        });
    }

    public function deleteProductColor(ProductColor $color): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($color){

            $color->delete();

        });
    }
}
