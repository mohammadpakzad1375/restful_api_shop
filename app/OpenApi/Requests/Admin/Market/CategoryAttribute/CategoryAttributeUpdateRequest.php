<?php

namespace App\OpenApi\Requests\Admin\Market\CategoryAttribute;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CategoryAttributeUpdateRequest",
    properties: [
        new OA\Property(
            property: "category_id",
            type: "integer",
            example: 1
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
    ]
)]
class CategoryAttributeUpdateRequest
{

}
