<?php

namespace App\OpenApi\Schemas\Market\Brand;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Brand",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
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
            type: "string",
            example: "images/brand/2026/07/01/1782899642_6824d2eb.png",
        ),
        new OA\Property(
            property: "tags",
            type: "string",
            example: "شیائومی-Xiaomi-Redmi-POCO-گوشی شیائومی-لوازم هوشمند-گجت"
        ),
    ],
    type: "object"
)]
class BrandSchema
{

}
