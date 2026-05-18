<?php

namespace App\Http\Services\BusinessLogic\Content;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\Content\PostCategory;

class PostCategoryService
{
    public function showAllPostCategories(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return PostCategory::orderBy('created_at','desc')->paginate(10);

        }, function () {

            //Do something

        });
    }

    public function createPostCategory($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $inputs['image'] = ImageService::save($inputs['image'], 'post-category');

            return PostCategory::create($inputs);

        });
    }

    public function updatePostCategory($inputs, PostCategory $category): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $category) {

            if (array_key_exists('image', $inputs))
            {
                ImageService::deleteImage($category->image);
                $inputs['image'] = ImageService::save($inputs['image'], 'post-category');
            }

           $category->update($inputs);
           return $category->refresh();

        });
    }

    public function deletePostCategory(PostCategory $category): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($category){

            $category->delete();

        });
    }
}
