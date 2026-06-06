<?php

namespace App\Http\Resources\Market\CommonDiscount;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class CommonDiscountApiResourceCollection extends ApiResourceCollection
{
    public $collects = CommonDiscountApiResource::class;

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
