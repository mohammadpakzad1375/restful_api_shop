<?php

namespace App\Http\Controllers\Api\Customer\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Customer\Market\Comment\CommentStoreApiRequest;
use App\Http\Resources\Market\Product\ProductApiResource;
use App\Http\Services\BusinessLogic\Market\CommentService;
use App\Http\Services\BusinessLogic\Market\ProductService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\Product;

class ProductController extends Controller
{
    private ProductService $productService;
    private CommentService $commentService;

    public function __construct(ProductService $productService, CommentService $commentService)
    {
        $this->productService = $productService;
        $this->commentService = $commentService;
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

    public function addComment(CommentStoreApiRequest $request, Product $product)
    {
        $result = $this->commentService->createComment($request->validated(), $product);

        return ApiResponse::withResponseMessage('Product comment created successfully.')
            ->build()
            ->response($result->success);
    }
}
