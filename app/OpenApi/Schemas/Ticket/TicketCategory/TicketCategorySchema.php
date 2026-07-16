<?php

namespace App\OpenApi\Schemas\Ticket\TicketCategory;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "TicketCategory",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1),
        new OA\Property(
            property: "name",
            type: "string",
            example: "پشتیبانی فنی"
        )
    ],
    type: "object"
)]
class TicketCategorySchema
{

}
