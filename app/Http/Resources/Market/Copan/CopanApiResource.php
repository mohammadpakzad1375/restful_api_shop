<?php

namespace App\Http\Resources\Market\Copan;

use App\Http\Resources\User\Customer\CustomerApiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CopanApiResource extends JsonResource
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
            'code' => $this->code,
            'amount_type' => $this->amount_type,
            'discount_ceiling' => $this->discount_ceiling,
            'start_date' => $this->start_date?->format('Y-m-d H:i:s'),
            'end_date' => $this->end_date?->format('Y-m-d H:i:s'),
            'user' => $this->whenLoaded('user',function (){

                return CustomerApiResource::make($this->user);

            },$this->user_id)
        ];
    }
}
