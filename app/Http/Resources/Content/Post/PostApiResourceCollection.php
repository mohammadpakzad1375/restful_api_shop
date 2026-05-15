<?php

namespace App\Http\Resources\Content\Post;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class PostApiResourceCollection extends ApiResourceCollection
{
    public $collects = PostApiResource::class;

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
