<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Market\CommonDiscount\CommonDiscountStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Market\CommonDiscount\CommonDiscountUpdateApiRequest;
use App\Http\Resources\Market\CommonDiscount\CommonDiscountApiResource;
use App\Http\Resources\Market\CommonDiscount\CommonDiscountApiResourceCollection;
use App\Http\Services\BusinessLogic\Market\CommonDiscountService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\CommonDiscount;
use Illuminate\Http\Request;

class CommonDiscountController extends Controller
{
    public function __construct(private CommonDiscountService $commonDiscountService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->commonDiscountService->showAllCommonDiscounts();

        return ApiResponse::withData(CommonDiscountApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommonDiscountStoreApiRequest $request)
    {
        $result = $this->commonDiscountService->createCommonDiscount($request->validated());

        return ApiResponse::withResponseMessage('CommonDiscount created successfully.')
            ->withResponseStatus(201)
            ->withData(CommonDiscountApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(CommonDiscount $commonDiscount)
    {
        return ApiResponse::withData(CommonDiscountApiResource::make($commonDiscount))
            ->build()
            ->response((bool) $commonDiscount);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommonDiscountUpdateApiRequest $request, CommonDiscount $commonDiscount)
    {
        $result = $this->commonDiscountService->updateCommonDiscount($request->validated(), $commonDiscount);

        return ApiResponse::withResponseMessage('CommonDiscount updated successfully.')
            ->withData(CommonDiscountApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommonDiscount $commonDiscount)
    {
        $result = $this->commonDiscountService->deleteCommonDiscount($commonDiscount);

        return ApiResponse::withResponseMessage('CommonDiscount deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
