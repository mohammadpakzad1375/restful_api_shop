<?php

namespace App\Http\Resources\Market\Brand;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandApiResource extends JsonResource
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
            'persian_name' => $this->persian_name,
            'original_name' => $this->original_name,
            'logo' => $this->logo,
            'tags' => $this->tags,
        ];
    }
}
