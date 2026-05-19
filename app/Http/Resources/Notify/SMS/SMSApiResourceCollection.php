<?php

namespace App\Http\Resources\Notify\SMS;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class SMSApiResourceCollection extends ApiResourceCollection
{
    public $collects = SMSApiResource::class;

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
