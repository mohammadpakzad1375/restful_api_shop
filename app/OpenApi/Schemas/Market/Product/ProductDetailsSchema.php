<?php

namespace App\OpenApi\Schemas\Market\Product;

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
            property: "view",
            type: "integer",
            example: 1
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
        ),
        new OA\Property(
            property: "colors",
            type: "array",
            items: new OA\Items(
                properties: [
                    new OA\Property(
                        property: "id",
                        type: "integer"
                    ),
                    new OA\Property(
                        property: "color_name",
                        type: "string"
                    ),
                    new OA\Property(
                        property: "color_code",
                        type: "string"
                    ),
                    new OA\Property(
                        property: "product_id",
                        type: "integer"
                    ),
                    new OA\Property(
                        property: "price_increase",
                        type: "string"
                    ),
                    new OA\Property(
                        property: "sold_number",
                        type: "integer"
                    ),
                    new OA\Property(
                        property: "frozen_number",
                        type: "integer"
                    ),
                    new OA\Property(
                        property: "marketable_number",
                        type: "integer"
                    )
                ],
                type: "object"
            ),
        ),
        new OA\Property(
            property: "gallery",
            type: "array",
            items: new OA\Items(
                properties: [
                    new OA\Property(
                        property: "id",
                        type: "integer"
                    ),
                    new OA\Property(
                        property: "image",
                        type: "string"
                    ),
                    new OA\Property(
                        property: "product_id",
                        type: "integer"
                    )
                ],
                type: "object"
            )
        ),
        new OA\Property(
            property: "attributeValue",
            type: "array",
            items: new OA\Items(
                properties: [
                    new OA\Property(
                        property: "category_attribute",
                        properties: [
                            new OA\Property(
                                property: "id",
                                type: "integer"
                            ),
                            new OA\Property(
                                property: "name",
                                type: "string"
                            ),
                            new OA\Property(
                                property: "unit",
                                type: "string"
                            ),
                            new OA\Property(
                                property: "category_id",
                                type: "integer"
                            )
                        ],
                        type: "object"
                    ),
                    new OA\Property(
                        property: "values",
                        type: "array",
                        items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: "value",
                                    type: "string"
                                ),
                                new OA\Property(
                                    property: "price_increase",
                                    type: "string"
                                ),
                                new OA\Property(
                                    property: "type",
                                    nullable: true
                                )
                            ],
                            type: "object"
                        )
                    )
                ],
                type: "object"
            )
        ),
        new OA\Property(
            property: "comments",
            ref: "#/components/schemas/ProductComment"
        ),
        new OA\Property(
            property: "activeAmazingSales",
            ref: "#/components/schemas/ProductCommentDetails"
        ),
    ],
    type: "object"
)]
class ProductDetailsSchema
{

}
