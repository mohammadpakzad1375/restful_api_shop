<?php

namespace App\Http\Resources\Market\Copan;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class CopanApiResourceCollection extends ApiResourceCollection
{
    public $collects = CopanApiResource::class;

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
