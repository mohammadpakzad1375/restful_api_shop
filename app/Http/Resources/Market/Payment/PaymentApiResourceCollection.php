<?php

namespace App\Http\Resources\Market\Payment;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class PaymentApiResourceCollection extends ApiResourceCollection
{
    public $collects = PaymentApiResource::class;

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
