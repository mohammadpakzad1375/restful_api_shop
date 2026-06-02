<?php

namespace App\Http\Resources\Market\Comment;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;

class CommentApiResourceCollection extends ApiResourceCollection
{
    public $collects = CommentApiResource::class;

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
