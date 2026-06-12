<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Market\Product\ProductStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Market\Product\ProductUpdateApiRequest;
use App\Http\Resources\Market\Product\ProductApiResource;
use App\Http\Resources\Market\Product\ProductApiResourceCollection;
use App\Http\Services\BusinessLogic\Market\ProductService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\Product;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->productService->showAllProducts();

        return ApiResponse::withData(ProductApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreApiRequest $request)
    {
        $result = $this->productService->createProduct($request->validated());

        return ApiResponse::withResponseMessage('Product created successfully.')
            ->withData(ProductApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $result = $this->productService->showProduct($product);

        return ApiResponse::withData(ProductApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateApiRequest $request, Product $product)
    {
        $result = $this->productService->updateProduct($request->validated(), $product);

        return ApiResponse::withResponseMessage('Product updated successfully.')
            ->withData(ProductApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $result = $this->productService->deleteProduct($product);

        return ApiResponse::withResponseMessage('Product deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
