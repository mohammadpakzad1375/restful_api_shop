<?php

namespace App\Http\Resources\Market\ProductCategory;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class ProductCategoryApiResourceCollection extends ApiResourceCollection
{
    public $collects = ProductCategoryApiResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

}
