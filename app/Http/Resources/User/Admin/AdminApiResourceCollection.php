<?php

namespace App\Http\Resources\User\Admin;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class AdminApiResourceCollection extends ApiResourceCollection
{
    public $collects = AdminApiResource::class;

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
