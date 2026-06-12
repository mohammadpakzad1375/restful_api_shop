<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\Market\Gallery;
use App\Models\Market\Product;

class GalleryService
{
    public function showProductGallery(Product $product): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($product){

            return $product->gallery;

        });
    }

    public function createProductGallery($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $inputs['image'] = ImageService::save($inputs['image'], 'product-gallery');

            $gallery = Gallery::create($inputs);
            return $gallery->refresh();

        });
    }

    public function deleteProductGallery(Gallery $gallery): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($gallery){

            $gallery->delete();

        });
    }
}
