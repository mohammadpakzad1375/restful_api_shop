<?php

namespace App\Http\Resources\User\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminApiResource extends JsonResource
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
        ];
    }
}
