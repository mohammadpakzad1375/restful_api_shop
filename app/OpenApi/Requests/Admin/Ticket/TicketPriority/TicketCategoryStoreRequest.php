<?php

namespace App\OpenApi\Requests\Admin\Ticket\TicketPriority;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "TicketPriorityStoreRequest",
    required: [
        "name",
    ],
    properties: [
        new OA\Property(
            property: "name",
            type: "string",
            example: "فوری"
        ),
        new OA\Property(
            property: "status",
            description: "TicketPriority status (optional)",
            type: "integer",
            example: 1,
            enum: [0, 1]
        )
    ]
)]
class TicketCategoryStoreRequest
{

}
