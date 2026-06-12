<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\Market\Product;

class ProductService
{
    public function showAllProducts(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Product::with(['category', 'brand'])->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function createProduct($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $inputs['image'] = ImageService::save($inputs['image'], 'product');

            $product = Product::create($inputs);
            return $product->refresh();

        });
    }

    public function showProduct(Product $product): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($product){

            return  $product->load(['category', 'brand']);

        });
    }

    public function updateProduct($inputs, Product $product): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $product) {

            if (array_key_exists('image', $inputs))
            {
                ImageService::deleteImage($product->image);
                $inputs['image'] = ImageService::save($inputs['image'], 'product');
            }

            $product->update($inputs);
           return $product->refresh();

        });
    }

    public function deleteProduct(Product $product): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($product){

            $product->delete();

        });
    }
}
