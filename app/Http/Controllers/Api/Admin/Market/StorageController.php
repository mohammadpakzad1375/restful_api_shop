<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Market\Storage\AddToStorageApiRequest;
use App\Http\Requests\ApiRequests\Admin\Market\Storage\StorageUpdateApiRequest;
use App\Http\Resources\Market\Product\ProductApiResource;
use App\Http\Services\BusinessLogic\Market\StorageService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function __construct(private StorageService $storageService)
    {
    }

    public function addToStorage(AddToStorageApiRequest $request, Product $product)
    {
        $result = $this->storageService->addProductToStorage($request->validated(), $product);

        return ApiResponse::withData(ProductApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorageUpdateApiRequest $request, Product $product)
    {
        $result = $this->storageService->updateProductInventory($request->validated(), $product);

        return ApiResponse::withResponseMessage('ProductInventory updated successfully.')
            ->withData(ProductApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }
}
