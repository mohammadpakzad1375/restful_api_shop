<?php

namespace App\OpenApi\Requests\Admin\Market\AttributeValue;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "AttributeValueStoreRequest",
    required: [
        "value",
        "price_increase",
        "category_attribute_id",
        "product_id"
    ],
    properties: [
        new OA\Property(
            property: "value",
            type: "string",
        ),
        new OA\Property(
            property: "price_increase",
            type: "numeric",
            example: 500000
        ),
        new OA\Property(
            property: "category_attribute_id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "product_id",
            type: "integer",
            example: 1
        ),
    ]
)]
class AttributeValueStoreRequest
{

}
