<?php

namespace App\Http\Controllers\Api\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Content\Post\PostStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Content\Post\PostUpdateApiRequest;
use App\Http\Resources\Content\Post\PostApiResource;
use App\Http\Resources\Content\Post\PostApiResourceCollection;
use App\Http\Services\BusinessLogic\Content\PostService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Content\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private PostService $postService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->postService->showAllPosts();

        return ApiResponse::withData(PostApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreApiRequest $request)
    {
        $result = $this->postService->createPost($request->validated());

        return ApiResponse::withResponseMessage('post created successfully.')
            ->withData(PostApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $result = $this->postService->showPost($post);

        return ApiResponse::withData(PostApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateApiRequest $request, Post $post)
    {
        $result = $this->postService->updatePost($request->validated(), $post);

        return ApiResponse::withResponseMessage('post updated successfully.')
            ->withData(PostApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $result = $this->postService->deletePost($post);

        return ApiResponse::withResponseMessage('post deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
