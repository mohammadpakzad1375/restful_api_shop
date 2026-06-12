<?php

namespace App\Http\Resources\Market\CommonDiscount;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommonDiscountApiResource extends JsonResource
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
            'percentage' => $this->percentage,
            'discount_ceiling' => $this->discount_ceiling,
            'minimum_order_amount' => $this->minimum_order_amount,
            'start_date' => $this->start_date?->format('Y-m-d H:i:s'),
            'end_date' => $this->end_date?->format('Y-m-d H:i:s'),
        ];
    }
}
