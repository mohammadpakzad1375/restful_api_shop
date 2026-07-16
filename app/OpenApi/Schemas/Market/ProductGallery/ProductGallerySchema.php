<?php

namespace App\OpenApi\Schemas\Market\ProductGallery;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductGallery",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "image",
            type: "string",
            example: "images/product/2026/07/01/redmi-note-14.jpg"
        ),
        new OA\Property(
            property: "product_id",
            type: "integer",
            example: 1,
        )
    ],
    type: "object"
)]
class ProductGallerySchema
{

}
