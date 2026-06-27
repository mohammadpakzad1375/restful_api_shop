<?php

namespace App\OpenApi\Requests\Admin\Ticket\TicketCategory;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "TicketCategoryUpdateRequest",
    properties: [
        new OA\Property(
            property: "name",
            type: "string",
            example: "پشتیبانی فنی"
        ),
        new OA\Property(
            property: "status",
            type: "integer",
            example: 1,
            enum: [0, 1]
        )
    ]
)]
class TicketCategoryUpdateRequest
{

}
