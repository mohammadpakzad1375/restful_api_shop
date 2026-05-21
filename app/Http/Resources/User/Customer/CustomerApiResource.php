<?php

namespace App\Http\Resources\User\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerApiResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'user_type' => $this->user_type,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'national_code' => $this->national_code,
            'profile_photo_path' => $this->profile_photo_path,
            'activation' => $this->activation,
            'activation_date' => $this->activation_date?->format('Y-m-d H:i:s'),
            'email_verified_at' => $this->email_verified_at?->format('Y-m-d H:i:s'),
            'status' => $this->status,
        ];
    }
}
