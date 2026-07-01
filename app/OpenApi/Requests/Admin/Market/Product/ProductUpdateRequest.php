<?php

namespace App\OpenApi\Requests\Admin\Market\Product;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductUpdateRequest",
    properties: [
        new OA\Property(
            property: "name",
            type: "string",
            example: "گوشی موبایل شیائومی Redmi Note 14"
        ),
        new OA\Property(
            property: "introduction",
            type: "string",
            example: "گوشی شیائومی Redmi Note 14 با نمایشگر AMOLED، پردازنده قدرتمند، دوربین 108 مگاپیکسلی و باتری 5500 میلی‌آمپرساعت."
        ),
        new OA\Property(
            property: "price",
            type: "number",
            example: 18500000
        ),
        new OA\Property(
            property: "category_id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "brand_id",
            type: "integer",
            example: 1,
            nullable: true
        ),
        new OA\Property(
            property: "published_at",
            description: "Unix timestamp",
            type: "integer",
            example: 1782864000
        ),
        new OA\Property(
            property: "image",
            type: "string",
            format: "binary"
        ),
        new OA\Property(
            property: "status",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "marketable",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "weight",
            type: "number",
            example: 190,
            nullable: true
        ),
        new OA\Property(
            property: "length",
            type: "number",
            example: 162.4,
            nullable: true
        ),
        new OA\Property(
            property: "width",
            type: "number",
            example: 75.7,
            nullable: true
        ),
        new OA\Property(
            property: "height",
            type: "number",
            example: 8.2,
            nullable: true
        ),
        new OA\Property(
            property: "tags",
            type: "string",
            example: "شیائومی،Xiaomi،Redmi Note 14،گوشی موبایل،اندروید،AMOLED"
        ),
    ]
)]
class ProductUpdateRequest
{

}
