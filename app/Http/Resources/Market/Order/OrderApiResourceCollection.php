<?php

namespace App\Http\Resources\Market\Order;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class OrderApiResourceCollection extends ApiResourceCollection
{
    public $collects = OrderApiResource::class;

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
