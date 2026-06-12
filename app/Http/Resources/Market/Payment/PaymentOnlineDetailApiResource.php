<?php

namespace App\Http\Resources\Market\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentOnlineDetailApiResource extends JsonResource
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
            'gateway' => $this->gateway,
            'transaction_id' => $this->transaction_id,
            'pay_date' => $this->pay_date?->format('Y-m-d H:i:s'),
            'bank_first_response' => $this->bank_first_response,
            'bank_second_response' => $this->bank_second_response,
        ];
    }
}
