<?php

namespace App\OpenApi\Requests\Admin\Market\ProductColor;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductColorStoreRequest",
    required: [
        "color_name",
        "color_code",
        "price_increase",
        "product_id"
    ],
    properties: [
        new OA\Property(
            property: "color_name",
            type: "string",
            example: "مشکی"
        ),
        new OA\Property(
            property: "color_code",
            description: "Color in HEX format",
            type: "string",
            example: "#000000"
        ),
        new OA\Property(
            property: "price_increase",
            type: "numeric",
            example: 500000
        ),
        new OA\Property(
            property: "product_id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "status",
            description: "ProductColor status (optional)",
            type: "integer",
            example: 1,
            enum: [0, 1]
        )
    ]
)]
class ProductColorStoreRequest
{

}
