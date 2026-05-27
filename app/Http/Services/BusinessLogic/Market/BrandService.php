<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\Market\Brand;
use App\Models\Market\Delivery;

class BrandService
{
    public function showAllBrands(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Brand::orderBy('created_at','desc')->paginate(10);

        });
    }

    public function createBrand($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $inputs['logo'] = ImageService::save($inputs['logo'], 'brand');

            $brand = Brand::create($inputs);

            return $brand->refresh();

        });
    }

    public function updateBrand($inputs, Brand $brand): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $brand){

            if (array_key_exists('logo', $inputs))
            {
                ImageService::deleteImage($brand->logo);
                $inputs['logo'] = ImageService::save($inputs['logo'], 'brand');
            }

            $brand->update($inputs);
            return $brand->refresh();

        });
    }

    public function deleteBrand(Brand $brand): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($brand){

            $brand->delete();

        });
    }
}
