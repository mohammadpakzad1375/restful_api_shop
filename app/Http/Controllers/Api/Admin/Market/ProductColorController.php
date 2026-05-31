<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Market\ProductColor\ProductColorStoreApiRequest;
use App\Http\Services\BusinessLogic\Market\ProductColorService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;

class ProductColorController extends Controller
{
    public function __construct(private ProductColorService $productColorService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $result = $this->productColorService->showAllProductColors($product);

        return ApiResponse::withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductColorStoreApiRequest $request)
    {
        $result = $this->productColorService->createProductColors($request->validated());

        return ApiResponse::withResponseMessage('ProductColor created successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductColor $color)
    {
        $result = $this->productColorService->deleteProductColor($color);

        return ApiResponse::withResponseMessage('ProductColor deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
