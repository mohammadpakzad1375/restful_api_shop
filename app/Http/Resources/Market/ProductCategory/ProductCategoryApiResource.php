<?php

namespace App\Http\Resources\Market\ProductCategory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryApiResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'show_in_menu' => $this->show_in_menu,
            'tags' => $this->tags,
            'parent' => $this->whenLoaded('parent',function (){

                return self::make($this->parent);

            },$this->parent_id),
            'children' => $this->whenLoaded('children',function (){

                return self::collection($this->children);

            }),
        ];
    }
}
