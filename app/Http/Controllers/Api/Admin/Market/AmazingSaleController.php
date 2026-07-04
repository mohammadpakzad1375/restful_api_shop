<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Market\AmazingSale\AmazingSaleStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Market\AmazingSale\AmazingSaleUpdateApiRequest;
use App\Http\Resources\Market\AmazingSale\AmazingSaleApiResource;
use App\Http\Resources\Market\AmazingSale\AmazingSaleApiResourceCollection;
use App\Http\Services\BusinessLogic\Market\AmazingSaleService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\AmazingSale;
use Illuminate\Http\Request;

class AmazingSaleController extends Controller
{
    public function __construct(private AmazingSaleService $amazingSaleService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->amazingSaleService->showAllAmazingSaleDiscounts();

        return ApiResponse::withData(AmazingSaleApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AmazingSaleStoreApiRequest $request)
    {
        $result = $this->amazingSaleService->createAmazingSale($request->validated());

        return ApiResponse::withResponseMessage('AmazingSale created successfully.')
            ->withResponseStatus(201)
            ->withData(AmazingSaleApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(AmazingSale $amazingSale)
    {
        $result = $this->amazingSaleService->showAmazingSale($amazingSale);

        return ApiResponse::withData(AmazingSaleApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AmazingSaleUpdateApiRequest $request, AmazingSale $amazingSale)
    {
        $result = $this->amazingSaleService->updateAmazingSale($request->validated(), $amazingSale);

        return ApiResponse::withResponseMessage('AmazingSale updated successfully.')
            ->withData(AmazingSaleApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AmazingSale $amazingSale)
    {
        $result = $this->amazingSaleService->deleteAmazingSale($amazingSale);

        return ApiResponse::withResponseMessage('AmazingSale deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
