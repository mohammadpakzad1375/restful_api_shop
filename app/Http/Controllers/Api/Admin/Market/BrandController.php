<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Market\Brand\BrandStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Market\Brand\BrandUpdateApiRequest;
use App\Http\Resources\Market\Brand\BrandApiResource;
use App\Http\Resources\Market\Brand\BrandApiResourceCollection;
use App\Http\Services\BusinessLogic\Market\BrandService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(private BrandService $brandService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->brandService->showAllBrands();

        return ApiResponse::withData(BrandApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreApiRequest $request)
    {
        $result = $this->brandService->createBrand($request->validated());

        return ApiResponse::withResponseMessage('Brand created successfully.')
            ->withData(BrandApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return ApiResponse::withData(BrandApiResource::make($brand))
            ->build()
            ->response((bool) $brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandUpdateApiRequest $request, Brand $brand)
    {
        $result = $this->brandService->updateBrand($request->validated(), $brand);

        return ApiResponse::withResponseMessage('Brand updated successfully.')
            ->withData(BrandApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $result = $this->brandService->deleteBrand($brand);

        return ApiResponse::withResponseMessage('Brand deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
