<?php

namespace App\OpenApi\Schemas\Admin\Market\AmazingSale;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "AmazingSale",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "percentage",
            type: "integer",
            example: 20,
            maximum: 100,
            minimum: 1
        ),
        new OA\Property(
            property: "start_date",
            type: "string",
            format: "date-time",
            example: "2026-06-18 13:29:51"
        ),
        new OA\Property(
            property: "end_date",
            type: "string",
            format: "date-time",
            example: "2026-06-28 13:28:31"
        ),
        new OA\Property(
            property: "product",
            type: "integer",
            example: 1
        )
    ],
    type: "object"
)]
class AmazingSaleSchema
{

}
