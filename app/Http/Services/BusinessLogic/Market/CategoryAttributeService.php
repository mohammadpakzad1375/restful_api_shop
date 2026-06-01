<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;

class CategoryAttributeService
{
    public function showAllAttributes(ProductCategory $category): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($category) {

            return $category->attributes;

        });
    }

    public function createAttribute($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $categoryAttribute = CategoryAttribute::create($inputs);
            return $categoryAttribute->refresh();

        });
    }

    public function updateAttribute($inputs, CategoryAttribute $categoryAttribute): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $categoryAttribute) {

            $categoryAttribute->update($inputs);
           return $categoryAttribute->refresh();

        });
    }

    public function deleteAttribute(CategoryAttribute $categoryAttribute): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($categoryAttribute){

            $categoryAttribute->delete();

        });
    }
}
