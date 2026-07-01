<?php

namespace App\OpenApi\Requests\Admin\Market\ProductGallery;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductGalleryStoreRequest",
    required: [
        "product_id",
        "image"
    ],
    properties: [
        new OA\Property(
            property: "product_id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "image",
            type: "string",
            format: "binary"
        )
    ]
)]
class ProductGalleryStoreRequest
{

}
