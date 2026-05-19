<?php

namespace App\Http\Resources\Notify\SMS;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SMSApiResource extends JsonResource
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
            'body' => $this->body,
            'published_at' => jalaliDate($this->published_at),
        ];
    }
}
