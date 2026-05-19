<?php

namespace App\Http\Resources\Notify\Email;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class EmailApiResourceCollection extends ApiResourceCollection
{
    public $collects = EmailApiResource::class;

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
