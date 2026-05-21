<?php

namespace App\Http\Resources\User\Customer;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class CustomerApiResourceCollection extends ApiResourceCollection
{
    public $collects = CustomerApiResource::class;

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
