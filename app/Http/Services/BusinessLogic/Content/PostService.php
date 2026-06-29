<?php

namespace App\Http\Services\BusinessLogic\Content;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\Content\Post;
use Illuminate\Support\Facades\Auth;

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
        $inputs['author_id'] = Auth::id();
        return app(ServiceWrapper::class)(function () use ($inputs){

            $inputs['image'] = ImageService::save($inputs['image'], 'post');

            $post = Post::create($inputs);

            return $post->load('postCategory');

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

            if (array_key_exists('image', $inputs))
            {
                ImageService::deleteImage($post->image);
                $inputs['image'] = ImageService::save($inputs['image'], 'post');
            }

            $post->update($inputs);
            return $post->load('postCategory');

        });
    }

    public function deletePost(Post $post): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($post){

            $post->delete();

        });
    }
}
