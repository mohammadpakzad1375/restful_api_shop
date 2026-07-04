<?php

namespace App\OpenApi\Schemas\Admin\Market\CommonDiscount;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CommonDiscount",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "title",
            type: "string",
            example: "تخفیف ویژه تابستان",
        ),
        new OA\Property(
            property: "percentage",
            type: "integer",
            example: 20,
            maximum: 100,
            minimum: 1
        ),
        new OA\Property(
            property: "discount_ceiling",
            type: "integer",
            example: 500000,
            nullable: true
        ),
        new OA\Property(
            property: "minimum_order_amount",
            type: "integer",
            example: 1000000,
            nullable: true
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
    ],
    type: "object"
)]
class CommonDiscountSchema
{

}
