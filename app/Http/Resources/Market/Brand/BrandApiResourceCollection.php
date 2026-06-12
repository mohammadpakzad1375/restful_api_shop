<?php

namespace App\Http\Resources\Market\Brand;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class BrandApiResourceCollection extends ApiResourceCollection
{
    public $collects = BrandApiResource::class;

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
