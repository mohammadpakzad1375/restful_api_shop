<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryAttributeValue;

class AttributeValueService
{
    public function showAllAttributeValues(CategoryAttribute $categoryAttribute): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($categoryAttribute) {

            return $categoryAttribute->values;

        });
    }

    public function createAttributeValue($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $attributeValue = CategoryAttributeValue::create($inputs);
            return $attributeValue->refresh();

        });
    }

    public function updateAttributeValue($inputs, CategoryAttributeValue $value): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $value) {

            $value->update($inputs);
           return $value->refresh();

        });
    }

    public function deleteAttributeValue(CategoryAttributeValue $value): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($value){

            $value->delete();

        });
    }
}
