<?php

namespace App\OpenApi\Schemas\Pagination;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PaginationLinks",
    properties: [
        new OA\Property(
            property: "first",
            type: "string",
            example: "?page=1"
        ),
        new OA\Property(
            property: "last",
            type: "string",
            example: "?page=5"
        ),
        new OA\Property(
            property: "prev",
            type: "string",
            example: "?page=1",
            nullable: true
        ),
        new OA\Property(property: "next",
            type: "string",
            example: "?page=3",
            nullable: true
        ),
    ],
    type: "object"
)]
class PaginationLinksSchema
{

}
