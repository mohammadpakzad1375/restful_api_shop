<?php

namespace App\Http\Services\BusinessLogic\Content;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Content\Post;

class PostService
{
    public function showAllPosts(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Post::with('postCategory')->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function createPost($inputs): ServiceResult
    {
        //when Auth develop
        $inputs['author_id'] = 1;
        return app(ServiceWrapper::class)(function () use ($inputs){

            $post = Post::create($inputs);

            return $post->refresh()->load('postCategory');

        });
    }

    public function showPost(Post $post): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($post){

            return  $post->load('postCategory');

        });
    }

    public function updatePost($inputs, Post $post): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $post){

            $post->update($inputs);
            return $post->refresh();

        });
    }

    public function deletePost(Post $post): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($post){

            $post->delete();

        });
    }
}
