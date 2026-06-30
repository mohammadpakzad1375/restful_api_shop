<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Market\ProductCategory\ProductCategoryStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Market\ProductCategory\ProductCategoryUpdateApiRequest;
use App\Http\Resources\Market\ProductCategory\ProductCategoryApiResource;
use App\Http\Resources\Market\ProductCategory\ProductCategoryApiResourceCollection;
use App\Http\Services\BusinessLogic\Market\ProductCategoryService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private ProductCategoryService $productCategoryService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->productCategoryService->showAllProductCategories();

        return ApiResponse::withData(ProductCategoryApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryStoreApiRequest $request)
    {
        $result = $this->productCategoryService->createProductCategory($request->validated());

        return ApiResponse::withResponseMessage('ProductCategory created successfully.')
            ->withResponseStatus(201)
            ->withData(ProductCategoryApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $category)
    {
        $result = $this->productCategoryService->showProductCategory($category);

        return ApiResponse::withData(ProductCategoryApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryUpdateApiRequest $request, ProductCategory $category)
    {
        $result = $this->productCategoryService->updateProductCategory($request->validated(), $category);

        return ApiResponse::withResponseMessage('ProductCategory updated successfully.')
            ->withData(ProductCategoryApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $category)
    {
        $result = $this->productCategoryService->deleteProductCategory($category);

        return ApiResponse::withResponseMessage('ProductCategory deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
