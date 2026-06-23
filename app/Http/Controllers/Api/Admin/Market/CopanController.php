<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Market\Copan\CopanStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Market\Copan\CopanUpdateApiRequest;
use App\Http\Resources\Market\Copan\CopanApiResource;
use App\Http\Resources\Market\Copan\CopanApiResourceCollection;
use App\Http\Services\BusinessLogic\Market\CopanService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\Copan;
use Illuminate\Http\Request;

class CopanController extends Controller
{
    public function __construct(private CopanService $copanService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->copanService->showAllCopanDiscounts();

        return ApiResponse::withData(CopanApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CopanStoreApiRequest $request)
    {
        $result = $this->copanService->createCopan($request->validated());

        return ApiResponse::withResponseMessage('Copan created successfully.')
            ->withData(CopanApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Copan $copan)
    {
        $result = $this->copanService->showCopan($copan);

        return ApiResponse::withData(CopanApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CopanUpdateApiRequest $request, Copan $copan)
    {
        $result = $this->copanService->updateCopan($request->validated(), $copan);

        return ApiResponse::withResponseMessage('Copan updated successfully.')
            ->withData(CopanApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Copan $copan)
    {
        $result = $this->copanService->deleteCopan($copan);

        return ApiResponse::withResponseMessage('Copan deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
