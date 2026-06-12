<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Market\ProductGallery\ProductGalleryStoreApiRequest;
use App\Http\Services\BusinessLogic\Market\GalleryService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\Gallery;
use App\Models\Market\Product;


class GalleryController extends Controller
{
    public function __construct(private GalleryService $galleryService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $result = $this->galleryService->showProductGallery($product);

        return ApiResponse::withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductGalleryStoreApiRequest $request)
    {
        $result = $this->galleryService->createProductGallery($request->validated());

        return ApiResponse::withResponseMessage('ProductGallery created successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $result = $this->galleryService->deleteProductGallery($gallery);

        return ApiResponse::withResponseMessage('ProductGallery deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
