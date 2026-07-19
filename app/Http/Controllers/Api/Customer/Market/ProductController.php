<?php

namespace App\Http\Controllers\Api\Customer\Market;

use App\Http\Controllers\Controller;
use App\Http\Resources\Market\Product\ProductApiResource;
use App\Http\Services\BusinessLogic\Market\ProductService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    public function product(Product $product)
    {
        if (!$product->isMarketable())
            return ApiResponse::withSuccess(false)
                ->withResponseMessage('This action is unauthorized.')
                ->withResponseStatus(403)
                ->build()
                ->response(true);

        $result = $this->productService->showProduct($product);

        return ApiResponse::withResponseMessage('Product retrieved successfully.')
            ->withData(ProductApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function addComment(Request $request)
    {

    }
}
