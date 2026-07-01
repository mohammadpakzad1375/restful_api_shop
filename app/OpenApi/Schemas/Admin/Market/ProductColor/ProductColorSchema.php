<?php

namespace App\OpenApi\Schemas\Admin\Market\ProductColor;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductColor",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "name",
            type: "string",
            example: "ارسال اکسپرس"
        ),
        new OA\Property(
            property: "amount",
            type: "string",
            example: "100000"
        ),
        new OA\Property(
            property: "time",
            type: "string",
            example: "1 روز"
        ),
    ],
    type: "object"
)]
class ProductColorSchema
{

}
