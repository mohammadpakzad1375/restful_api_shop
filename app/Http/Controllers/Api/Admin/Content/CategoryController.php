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


    public function index()
    {
        $result = $this->postCategoryService->showAllPostCategories();

        return ApiResponse::withData(PostCategoryApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function store(PostCategoryStoreApiRequest $request)
    {
        $result = $this->postCategoryService->createPostCategory($request->validated());

        return ApiResponse::withResponseMessage('postCategory created successfully.')
            ->withResponseStatus(201)
            ->withData(PostCategoryApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function show(PostCategory $category)
    {
        return ApiResponse::withData(PostCategoryApiResource::make($category))
            ->build()
            ->response((bool) $category);
    }

    public function update(PostCategoryUpdateApiRequest $request, PostCategory $category)
    {
        $result = $this->postCategoryService->updatePostCategory($request->validated(), $category);

        return ApiResponse::withResponseMessage('postCategory updated successfully.')
            ->withData(PostCategoryApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }


    public function destroy(PostCategory $category)
    {
        $result = $this->postCategoryService->deletePostCategory($category);

        return ApiResponse::withResponseMessage('PostCategory deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
