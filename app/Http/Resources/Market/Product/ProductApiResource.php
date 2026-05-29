<?php

namespace App\Http\Resources\Market\Product;

use App\Http\Resources\Market\Brand\BrandApiResource;
use App\Http\Resources\Market\ProductCategory\ProductCategoryApiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductApiResource extends JsonResource
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
            'introduction' => $this->introduction,
            'image' => $this->image,
            'weight' => $this->weight,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'price' => $this->price,
            'marketable' => $this->marketable,
            'status' => $this->status,
            'tags' => $this->tags,
            'published_at' => $this->published_at?->format('Y-m-d H:i:s'),
            'category' => $this->whenLoaded('category',function (){

                return ProductCategoryApiResource::make($this->category);

            },$this->category_id),
            'brand' => $this->whenLoaded('brand',function (){

                return BrandApiResource::make($this->brand);

            },$this->brand_id),
        ];
    }
}
