<?php

namespace App\Http\Resources\Content\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentApiResource extends JsonResource
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
            'body' => $this->body,
            'seen' => $this->seen,
            'approved' => $this->approved,
            'status' => $this->status,
            'author' => $this->whenLoaded('author',function (){

                return self::make($this->author);

            },$this->author_id),
            'post' => $this->whenLoaded('commentable',function (){

                return self::make($this->commentable);

            },$this->commentable_id),
            'parent' => $this->whenLoaded('parent',function (){

                return self::make($this->parent);

            },$this->parent_id),
            'answers' => $this->whenLoaded('answers',function (){

                return self::make($this->answers);

            }),
        ];
    }
}
