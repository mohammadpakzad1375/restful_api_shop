<?php

namespace App\OpenApi\Schemas\Admin\Market\Product;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductDetails",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
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
            type: "string",
            example: "18500000"
        ),
        new OA\Property(
            property: "published_at",
            type: "string",
            example: "2026-06-24 23:00:00"
        ),
        new OA\Property(
            property: "image",
            type: "string",
            example: "images/product/2026/07/01/redmi-note-14.jpg"
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
            example: 190
        ),
        new OA\Property(
            property: "length",
            type: "number",
            example: 162.4
        ),
        new OA\Property(
            property: "width",
            type: "number",
            example: 75.7
        ),
        new OA\Property(
            property: "height",
            type: "number",
            example: 8.2
        ),
        new OA\Property(
            property: "sold_number",
            type: "integer",
            example: 1,
            nullable: true
        ),
        new OA\Property(
            property: "frozen_number",
            type: "integer",
            example: 1,
            nullable: true
        ),
        new OA\Property(
            property: "marketable_number",
            type: "integer",
            example: 1,
            nullable: true
        ),
        new OA\Property(
            property: "tags",
            type: "string",
            example: "شیائومی،Xiaomi،Redmi Note 14،گوشی موبایل،اندروید،AMOLED"
        ),
        new OA\Property(
            property: "category",
            ref: "#/components/schemas/ProductCategory"
        ),
        new OA\Property(
            property: "brand",
            ref: "#/components/schemas/Brand"
        )
    ],
    type: "object"
)]
class ProductDetailsSchema
{

}
