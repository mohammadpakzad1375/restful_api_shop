<?php

namespace App\Http\Controllers\Api\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Content\PostCategory\PostCategoryStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Content\PostCategory\PostCategoryUpdateApiRequest;
use App\Http\Resources\Content\PostCategory\PostCategoryApiResource;
use App\Http\Resources\Content\PostCategory\PostCategoryApiResourceCollection;
use App\Http\Services\BusinessLogic\Content\PostCategoryService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Content\PostCategory;

class CategoryController extends Controller
{
    public function __construct(private PostCategoryService $postCategoryService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->postCategoryService->showAllPostCategories();

        return ApiResponse::withData(PostCategoryApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCategoryStoreApiRequest $request)
    {
        $result = $this->postCategoryService->createPostCategory($request->validated());

        return ApiResponse::withResponseMessage('postCategory created successfully.')
            ->withData(PostCategoryApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(PostCategory $category)
    {
        return new PostCategoryApiResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostCategoryUpdateApiRequest $request, PostCategory $category)
    {
        $result = $this->postCategoryService->updatePostCategory($request->validated(), $category);

        return ApiResponse::withResponseMessage('postCategory updated successfully.')
            ->withData(PostCategoryApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $category)
    {
        $result = $this->postCategoryService->deletePostCategory($category);

        return ApiResponse::withResponseMessage('postCategory deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
