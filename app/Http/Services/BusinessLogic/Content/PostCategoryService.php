<?php

namespace App\Http\Services\BusinessLogic\Content;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
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

            return PostCategory::create($inputs);

        });
    }

    public function updatePostCategory($inputs, PostCategory $category): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $category){

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
