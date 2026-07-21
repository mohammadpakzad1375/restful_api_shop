<?php

namespace App\Http\Controllers\Api\Customer\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Customer\Market\Comment\CommentStoreApiRequest;
use App\Http\Resources\Market\Product\ProductApiResource;
use App\Http\Services\BusinessLogic\Market\CommentService;
use App\Http\Services\BusinessLogic\Market\ProductService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Http\Services\RestfulApi\ApiResponse\ApiResponse as ApiResponseService;
use App\Models\Market\Product;

class ProductController extends Controller
{
    private ProductService $productService;
    private CommentService $commentService;
    private ApiResponseService $apiResponse;

    public function __construct(
        ProductService $productService,
        CommentService $commentService,
        ApiResponseService $apiResponse
    )
    {
        $this->productService = $productService;
        $this->commentService = $commentService;
        $this->apiResponse = $apiResponse;
    }


    public function product(Product $product)
    {
        if (!$product->isMarketable())
            return ApiResponse::withSuccess(false)
                ->withResponseMessage('This action is unauthorized.')
                ->withResponseStatus(403)
                ->build()
                ->response(true);

        $result = $this->productService->getProductWithRelated($product);


        if (!$result->success || !$result->data['success'])
            return $this->apiResponse->response(false);

        $data = [
            'product' => ProductApiResource::make($result->data['data']['product']),
            'relatedProducts' => ProductApiResource::collection($result->data['data']['relatedProducts'])
        ];

        $this->apiResponse->setResponseMessage('Product retrieved successfully.');
        $this->apiResponse->setData($data);

        return $this->apiResponse->response(true);
    }

    public function addComment(CommentStoreApiRequest $request, Product $product)
    {
        $result = $this->commentService->createComment($request->validated(), $product);

        return ApiResponse::withResponseMessage('Product comment created successfully.')
            ->build()
            ->response($result->success);
    }
}
