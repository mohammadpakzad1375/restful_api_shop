<?php

namespace App\Http\Resources\Market\Payment;

use App\Http\Resources\User\Customer\CustomerApiResource;
use App\Models\Market\CashPayment;
use App\Models\Market\OnlinePayment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentApiResource extends JsonResource
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
            'amount' => $this->amount,
            'status' => $this->status,
            'type' => $this->type,
            'user' => $this->whenLoaded('user',function (){

                return CustomerApiResource::make($this->user);

            },$this->user_id),
            'payment_details' => $this->whenLoaded('paymentable', function () {
                return match (get_class($this->paymentable)) {
                    OnlinePayment::class => PaymentOnlineDetailApiResource::make($this->paymentable),
                    CashPayment::class => PaymentCashDetailApiResource::make($this->paymentable),
                    default => null,
                };
            }),
        ];
    }
}
