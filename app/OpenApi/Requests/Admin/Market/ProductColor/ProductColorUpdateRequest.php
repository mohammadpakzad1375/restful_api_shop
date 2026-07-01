<?php

namespace App\OpenApi\Requests\Admin\Market\ProductColor;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductColorUpdateRequest",
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
            type: "integer",
            example: 500000
        ),
        new OA\Property(
            property: "product_id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "status",
            type: "integer",
            example: 1,
            enum: [0, 1]
        )
    ])]
class ProductColorUpdateRequest
{

}
