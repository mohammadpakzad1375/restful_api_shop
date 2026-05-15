<?php

namespace App\Http\Resources\Content\Post;

use App\Http\Resources\Content\PostCategory\PostCategoryApiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->body,
            'body' => $this->summary,
            'image' => $this->image,
            'commentable' => $this->commentable,
            'published_at' => $this->published_at,
            'author' => $this->author_id,
            'category' => $this->whenLoaded('postCategory',function (){

                return PostCategoryApiResource::make($this->postCategory);

            },$this->category_id),
        ];
    }
}
