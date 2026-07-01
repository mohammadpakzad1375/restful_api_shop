<?php

namespace App\OpenApi\Requests\Admin\Market\Brand;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "BrandStoreRequest",
    required: [
        "persian_name",
        "original_name",
        "logo",
        "tags"
    ],
    properties: [
        new OA\Property(
            property: "persian_name",
            type: "string",
            example: "شیائومی"
        ),
        new OA\Property(
            property: "original_name",
            type: "string",
            example: "Xiaomi"
        ),
        new OA\Property(
            property: "logo",
            description: "Brand logo",
            type: "string",
            format: "binary"
        ),
        new OA\Property(
            property: "tags",
            type: "string",
            example: "شیائومی-Xiaomi-Redmi-POCO-گوشی شیائومی-لوازم هوشمند-گجت"
        ),
        new OA\Property(
            property: "status",
            description: "Brand status (optional)",
            type: "integer",
            example: 1,
            enum: [0, 1]
        )
    ]
)]
class BrandStoreRequest
{

}
