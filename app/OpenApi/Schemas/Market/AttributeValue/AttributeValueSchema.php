<?php

namespace App\OpenApi\Schemas\Market\AttributeValue;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "AttributeValue",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "value",
            type: "string",
        ),
        new OA\Property(
            property: "price_increase",
            type: "string",
            example: "0.000"
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
    ],
    type: "object"
)]
class AttributeValueSchema
{

}
