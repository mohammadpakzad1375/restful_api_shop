<?php

namespace App\Http\Resources\Market\Product;

use App\Http\Resources\Market\AmazingSale\AmazingSaleApiResource;
use App\Http\Resources\Market\Brand\BrandApiResource;
use App\Http\Resources\Market\Comment\CommentApiResourceCollection;
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
            'view' => $this->view,
            'weight' => $this->weight,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'price' => $this->price,
            'marketable' => $this->marketable,
            'status' => $this->status,
            'sold_number' => (int) $this->sold_number,
            'frozen_number' => (int) $this->frozen_number,
            'marketable_number' => (int) $this->marketable_number,
            'tags' => $this->tags,
            'published_at' => $this->published_at?->format('Y-m-d H:i:s'),
            'category' => $this->whenLoaded('category',function (){

                return ProductCategoryApiResource::make($this->category);

            },$this->category_id),
            'brand' => $this->whenLoaded('brand',function (){

                return BrandApiResource::make($this->brand);

            },$this->brand_id),
            'colors' => $this->whenLoaded('colors',function (){

                return $this->colors;

            }),
            'gallery' => $this->whenLoaded('gallery',function (){

                return $this->gallery;

            }),
            'attributeValue' => $this->whenLoaded('attributeValue',function (){

                return $this->attributeValue
                    ->groupBy('category_attribute_id')
                    ->map(function ($items){
                    return [
                        'category_attribute' => $items->first()->attribute,
                        'values' => $items->map(function ($item){
                            return [
                                'value' => $item->value,
                                'price_increase' => $item->price_increase,
                                'type' => $item->type,
                            ];
                        })
                    ];
                })->values();

            }),
            'comments' => $this->whenLoaded('approvedComments',function (){

                return CommentApiResourceCollection::make($this->comments);

            }),
            'activeAmazingSales' => $this->whenLoaded('amazingSales',function (){

                if ($this->amazingSales()->active()->exists())
                {
                    $activeAmazingSale = $this->amazingSales()->active()->first();

                    return AmazingSaleApiResource::make($activeAmazingSale);
                }

            }),
        ];
    }
}
