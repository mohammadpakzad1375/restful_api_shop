<?php

namespace App\OpenApi\Schemas\Admin\Content\PostCategory;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PostCategory",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "name", type: "string", example: "تکنولوژی"),
        new OA\Property(property: "description", type: "string", example: "بررسی جدیدترین تکنولوژی‌ها"),
        new OA\Property(property: "image", type: "string", example: "images/category.png"),
        new OA\Property(property: "tags", type: "string", example: "tech"),
    ],
    type: "object"
)]
class PostCategorySchema
{

}
