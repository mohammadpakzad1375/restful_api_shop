<?php

namespace App\OpenApi\Schemas\Admin\Market\Copan;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CopanDetails",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "code",
            type: "string",
            example: "OFF-260704-V03FVO"
        ),
        new OA\Property(
            property: "amount_type",
            type: "string",
            example: "percentage",
            enum: ["percentage", "price_unit"]
        ),
        new OA\Property(
            property: "discount_ceiling",
            type: "integer",
            example: 500000,
            nullable: true
        ),
        new OA\Property(
            property: "start_date",
            type: "string",
            format: "date-time",
            example: "2026-06-06 14:10:00"
        ),
        new OA\Property(
            property: "end_date",
            type: "string",
            format: "date-time",
            example: "2026-07-06 14:10:00"
        ),
        new OA\Property(
            property: "user",
            ref: "#/components/schemas/Customer"
        ),
    ],
    type: "object"
)]
class CopanDetailsSchema
{

}
