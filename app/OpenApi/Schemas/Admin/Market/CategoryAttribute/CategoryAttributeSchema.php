<?php

namespace App\OpenApi\Schemas\Admin\Market\CategoryAttribute;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CategoryAttribute",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "category_id",
            type: "integer",
            example: 1,
        ),
        new OA\Property(
            property: "name",
            type: "string",
            example: "سایز صفحه نمایش"
        ),
        new OA\Property(
            property: "unit",
            type: "string",
            example: "اینچ"
        )
    ],
    type: "object"
)]
class CategoryAttributeSchema
{

}
