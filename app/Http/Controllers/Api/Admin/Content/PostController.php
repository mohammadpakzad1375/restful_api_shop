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
use OpenApi\Attributes as OA;

class PostController extends Controller
{
    public function __construct(private PostService $postService)
    {
    }

    public function index()
    {
        $result = $this->postService->showAllPosts();

        return ApiResponse::withData(PostApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function store(PostStoreApiRequest $request)
    {
        $result = $this->postService->createPost($request->validated());

        return ApiResponse::withResponseMessage('Post created successfully.')
            ->withResponseStatus(201)
            ->withData(PostApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function show(Post $post)
    {
        $result = $this->postService->showPost($post);

        return ApiResponse::withData(PostApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function update(PostUpdateApiRequest $request, Post $post)
    {
        $result = $this->postService->updatePost($request->validated(), $post);

        return ApiResponse::withResponseMessage('Post updated successfully.')
            ->withData(PostApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function destroy(Post $post)
    {
        $result = $this->postService->deletePost($post);

        return ApiResponse::withResponseMessage('Post deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
