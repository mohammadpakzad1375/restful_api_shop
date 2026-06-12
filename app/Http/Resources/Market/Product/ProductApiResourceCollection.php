<?php

namespace App\Http\Resources\Market\Product;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class ProductApiResourceCollection extends ApiResourceCollection
{
    public $collects = ProductApiResource::class;

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
