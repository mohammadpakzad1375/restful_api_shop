<?php

namespace App\OpenApi\Requests\Admin\Market\ProductCategory;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductCategoryStoreRequest",
    required: ["name","description","image","parent_id","tags"],
    properties: [
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
            type: "string",
            format: "binary"
        ),
        new OA\Property(
            property: "show_in_menu",
            description: "Product category show_in_menu (optional)",
            type: "integer",
            example: 1,
            enum: [0, 1],
        ),
        new OA\Property(
            property: "parent_id",
            type: "integer",
            example: null,
            nullable: true,
        ),
        new OA\Property(
            property: "tags",
            type: "string",
            example: "موبایل-تبلت-گوشی-لوازم جانبی"
        ),
        new OA\Property(
            property: "status",
            description: "Product category status (optional)",
            type: "integer",
            example: 1,
            enum: [0, 1],
        ),
    ]
)]
class ProductCategoryStoreRequest
{

}
