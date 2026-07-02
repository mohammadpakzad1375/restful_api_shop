<?php

namespace App\Http\Controllers\Api\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Market\AttributeValue\AttributeValueStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Market\AttributeValue\AttributeValueUpdateApiRequest;
use App\Http\Services\BusinessLogic\Market\AttributeValueService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryAttributeValue;

class AttributeValueController extends Controller
{
    public function __construct(private AttributeValueService $attributeValueService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CategoryAttribute $category_attribute)
    {
        $result = $this->attributeValueService->showAllAttributeValues($category_attribute);

        return ApiResponse::withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeValueStoreApiRequest $request)
    {
        $result = $this->attributeValueService->createAttributeValue($request->validated());

        return ApiResponse::withResponseMessage('AttributeValue created successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryAttributeValue $value)
    {
        return ApiResponse::withData($value)
            ->build()
            ->response((bool) $value);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeValueUpdateApiRequest $request, CategoryAttributeValue $value)
    {
        $result = $this->attributeValueService->updateAttributeValue($request->validated(), $value);

        return ApiResponse::withResponseMessage('AttributeValue updated successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAttributeValue $value)
    {
        $result = $this->attributeValueService->deleteAttributeValue($value);

        return ApiResponse::withResponseMessage('AttributeValue deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
