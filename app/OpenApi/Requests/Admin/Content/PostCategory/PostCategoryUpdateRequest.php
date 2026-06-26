<?php

namespace App\OpenApi\Requests\Admin\Content\PostCategory;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PostCategoryUpdateRequest",
    properties: [
        new OA\Property(
            property: "name",
            type: "string",
            example: "ورزشی"
        ),
        new OA\Property(
            property: "description",
            type: "string",
            example: "بررسی جدید ترین خبرهای ورزشی"
        ),
        new OA\Property(
            property: "image",
            description: "Category image",
            type: "string",
            format: "binary"
        ),
        new OA\Property(
            property: "tags",
            type: "string",
            example: "ورزشی"
        ),
        new OA\Property(
            property: "status",
            type: "integer",
            example: 1,
            enum: [0, 1],
        ),
    ]
)]
class PostCategoryUpdateRequest
{

}
