<?php

namespace App\Http\Resources\Market\Delivery;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class DeliveryApiResourceCollection extends ApiResourceCollection
{
    public $collects = DeliveryApiResource::class;

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
