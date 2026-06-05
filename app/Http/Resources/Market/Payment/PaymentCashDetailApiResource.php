<?php

namespace App\Http\Resources\Market\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentCashDetailApiResource extends JsonResource
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
            'cash_receiver' => $this->gateway,
            'pay_date' => $this->pay_date?->format('Y-m-d H:i:s'),
        ];
    }
}
