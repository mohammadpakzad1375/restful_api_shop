<?php

namespace App\OpenApi\Schemas\Admin\Ticket\TicketPriority;

use OpenApi\Attributes as OA;
#[OA\Schema(
    schema: "TicketPriority",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1),
        new OA\Property(
            property: "name",
            type: "string",
            example: "فوری"
        )
    ],
    type: "object"
)]
class TicketPrioritySchema
{

}
