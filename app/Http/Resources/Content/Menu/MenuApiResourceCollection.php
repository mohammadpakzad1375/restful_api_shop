<?php

namespace App\Http\Resources\Content\Menu;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class MenuApiResourceCollection extends ApiResourceCollection
{
    public $collects = MenuApiResource::class;

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
