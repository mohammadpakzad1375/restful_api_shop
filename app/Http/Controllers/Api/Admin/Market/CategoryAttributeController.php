<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Market\CategoryAttribute\CategoryAttributeStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Market\CategoryAttribute\CategoryAttributeUpdateApiRequest;
use App\Http\Services\BusinessLogic\Market\CategoryAttributeService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\ProductCategory;

class CategoryAttributeController extends Controller
{
    public function __construct(private CategoryAttributeService $categoryAttributeService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ProductCategory $category)
    {
        $result = $this->categoryAttributeService->showAllAttributes($category);

        return ApiResponse::withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryAttributeStoreApiRequest $request)
    {
        $result = $this->categoryAttributeService->createAttribute($request->validated());

        return ApiResponse::withResponseMessage('Attribute created successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryAttribute $categoryAttribute)
    {
        return ApiResponse::withData($categoryAttribute)
            ->build()
            ->response((bool) $categoryAttribute);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryAttributeUpdateApiRequest $request, CategoryAttribute $categoryAttribute)
    {
        $result = $this->categoryAttributeService->updateAttribute($request->validated(), $categoryAttribute);

        return ApiResponse::withResponseMessage('Attribute updated successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAttribute $categoryAttribute)
    {
        $result = $this->categoryAttributeService->deleteAttribute($categoryAttribute);

        return ApiResponse::withResponseMessage('Attribute deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
