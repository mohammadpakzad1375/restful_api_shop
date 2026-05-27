<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\Market\ProductCategory;

class ProductCategoryService
{
    public function showAllProductCategories(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return ProductCategory::with('parent')->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function createProductCategory($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $inputs['image'] = ImageService::save($inputs['image'], 'product-category');

            return ProductCategory::create($inputs);

        });
    }

    public function showProductCategory(ProductCategory $category): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($category){

            return  $category->load(['parent', 'children']);

        });
    }

    public function updateProductCategory($inputs, ProductCategory $category): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $category) {

            if (array_key_exists('image', $inputs))
            {
                ImageService::deleteImage($category->image);
                $inputs['image'] = ImageService::save($inputs['image'], 'product-category');
            }

           $category->update($inputs);
           return $category->refresh();

        });
    }

    public function deleteProductCategory(ProductCategory $category): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($category){

            $category->delete();

        });
    }
}
