<?php

namespace App\Http\Resources\Market\AmazingSale;

use App\Http\Resources\Market\Product\ProductApiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AmazingSaleApiResource extends JsonResource
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
            'percentage' => $this->percentage,
            'start_date' => $this->start_date?->format('Y-m-d H:i:s'),
            'end_date' => $this->end_date?->format('Y-m-d H:i:s'),
            'product' => $this->whenLoaded('product',function (){

                return ProductApiResource::make($this->product);

            },$this->product_id)
        ];
    }
}
