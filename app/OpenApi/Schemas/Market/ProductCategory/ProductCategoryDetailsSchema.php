<?php

namespace App\OpenApi\Schemas\Market\ProductCategory;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductCategoryDetails",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "name",
            type: "string",
            example: "موبایل و تبلت"
        ),
        new OA\Property(
            property: "description",
            type: "string",
            example: "دسته‌بندی شامل انواع گوشی موبایل، تبلت و لوازم جانبی مرتبط با آن‌ها."
        ),
        new OA\Property(
            property: "image",
            description: "Category image",
            example: "images/product-category/2026/06/24/image.png"
        ),
        new OA\Property(
            property: "show_in_menu",
            type: "integer",
            example: 1,
            enum: [0, 1],
        ),
        new OA\Property(
            property: "tags",
            type: "string",
            example: "موبایل-تبلت-گوشی-لوازم جانبی"
        ),
        new OA\Property(
            property: "parent",
            example: null,
            nullable: true
        ),
        new OA\Property(
            property: "children",
            type: "array",
            items: new OA\Items(
                type: "object"
            ),
            example: []
        )
    ],
    type: "object"
)]
class ProductCategoryDetailsSchema
{

}
