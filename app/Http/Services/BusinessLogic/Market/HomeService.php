<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;

class HomeService
{
    private AmazingSaleService $amazingSaleService;
    private ProductService $productService;

    public function __construct(AmazingSaleService $amazingSaleService, ProductService $productService)
    {
        $this->amazingSaleService = $amazingSaleService;
        $this->productService = $productService;
    }

    public function home(): ServiceResult
    {
        return app(ServiceWrapper::class)(function () {

            $mostViewProductsResult = $this->productService->getMostViewProducts();
            $newestProductsResult = $this->productService->getNewestProducts();
            $bestSellingProductsResult = $this->productService->getBestSellingProducts();
            $mostAmazingSaleProductsResult = $this->amazingSaleService->getMostAmazingSaleProducts();

            return [
                'success' => $mostViewProductsResult->success &&
                    $newestProductsResult->success &&
                    $bestSellingProductsResult->success &&
                    $mostAmazingSaleProductsResult->success,
                'data' => [
                    'mostViewProducts' => $mostViewProductsResult->data,
                    'newestProducts' => $newestProductsResult->data,
                    'bestSellingProducts' => $bestSellingProductsResult->data,
                    'mostAmazingSaleProducts' => $mostViewProductsResult->data
                ]
            ];

        });
    }
}
