<?php

namespace App\Http\Resources\Ticke\Ticket;

use App\Http\Resources\User\Admin\AdminApiResource;
use App\Http\Resources\User\Customer\CustomerApiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketApiResource extends JsonResource
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
            'subject' => $this->subject,
            'description' => $this->description,
            'seen' => $this->seen,
            'status' => $this->status,
            'ticket_admin_id' => $this->reference_id,
            'ticket_admin' => $this->whenLoaded('ticketAdmin.user',function (){

                return AdminApiResource::make($this->ticketAdmin->user);

            }),
            'user' => $this->whenLoaded('user',function (){

                return CustomerApiResource::make($this->user);

            },$this->user_id),
            'category' => $this->whenLoaded('ticketCategory',function (){

                return $this->ticketCategory;

            },$this->category_id),
            'priority' => $this->whenLoaded('ticketPriority',function (){

                return $this->ticketPriority;

            },$this->priority_id),
            'parent' => $this->whenLoaded('parent',function (){

                return self::make($this->parent);

            },$this->ticket_id),
            'answers' => $this->whenLoaded('answers',function (){

                return TicketApiResourceCollection::make($this->answers);

            }),
        ];
    }
}
