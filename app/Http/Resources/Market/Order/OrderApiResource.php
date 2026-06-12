<?php

namespace App\Http\Resources\Market\Order;

use App\Http\Resources\Market\CommonDiscount\CommonDiscountApiResource;
use App\Http\Resources\Market\Copan\CopanApiResource;
use App\Http\Resources\Market\Delivery\DeliveryApiResource;
use App\Http\Resources\Market\Payment\PaymentApiResource;
use App\Http\Resources\User\Customer\CustomerApiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderApiResource extends JsonResource
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
            'user' => $this->whenLoaded('user',function (){

                return CustomerApiResource::make($this->user);

            },$this->user_id),
            'address_id' => $this->address_id,
            'address_object' => $this->address_object,
            'payment' => $this->whenLoaded('payment',function (){

                return PaymentApiResource::make($this->payment);

            },$this->payment_id),
            'payment_object' => $this->payment_object,
            'payment_type' => $this->payment_type,
            'payment_status' => $this->payment_status,
            'payment_status_label' => $this->payment->status,
            'delivery' => $this->whenLoaded('delivery',function (){

                return DeliveryApiResource::make($this->delivery);

            },$this->delivery_id),
            'delivery_object' => $this->delivery_object,
            'delivery_amount' => $this->delivery_amount,
            'delivery_status' => $this->delivery_status,
            'delivery_status_label' => $this->deliveryStatusLabel,
            'delivery_date' => $this->delivery_date?->format('Y-m-d H:i:s'),
            'order_final_amount' => $this->order_final_amount,
            'order_discount_amount' => $this->order_discount_amount,
            'copan' => $this->whenLoaded('copan',function (){

                return CopanApiResource::make($this->copan);

            },$this->copan_id),
            'copan_object' => $this->copan_object,
            'order_copan_discount_amount' => $this->order_copan_discount_amount,
            'commonDiscount' => $this->whenLoaded('commonDiscount',function (){

                return CommonDiscountApiResource::make($this->commonDiscount);

            },$this->common_discount_id),
            'common_discount_object' => $this->common_discount_object,
            'order_common_discount_amount' => $this->order_common_discount_amount,
            'order_total_products_discount_amount' => $this->order_total_products_discount_amount,
            'order_status' => $this->order_status,
            'order_status_label' => $this->orderStatusLabel,
        ];
    }
}
