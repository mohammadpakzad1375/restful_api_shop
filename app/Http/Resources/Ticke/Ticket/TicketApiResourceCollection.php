<?php

namespace App\Http\Resources\Ticke\Ticket;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class TicketApiResourceCollection extends ApiResourceCollection
{
    public $collects = TicketApiResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

}
