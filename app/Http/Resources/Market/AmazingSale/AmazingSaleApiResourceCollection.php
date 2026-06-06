<?php

namespace App\Http\Resources\Market\AmazingSale;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class AmazingSaleApiResourceCollection extends ApiResourceCollection
{
    public $collects = AmazingSaleApiResource::class;

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
