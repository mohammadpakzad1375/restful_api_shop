<?php

namespace App\OpenApi\Requests\Admin\Content\Post;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PostStoreRequest",
    required: [
        "title",
        "summary",
        "body",
        "category_id",
        "image",
        "commentable",
        "published_at",
        "tags"
    ],
    properties: [
        new OA\Property(
            property: "title",
            type: "string",
            example: "هوش مصنوعی چگونه آینده توسعه نرم‌افزار را متحول می‌کند؟",
        ),
        new OA\Property(
            property: "summary",
            type: "string",
            example: "هوش مصنوعی در حال تغییر روش توسعه، تست و نگهداری نرم‌افزارها است.",
        ),
        new OA\Property(
            property: "body",
            type: "string",
            example: "در سال‌های اخیر، هوش مصنوعی به یکی از مهم‌ترین فناوری‌های تأثیرگذار بر صنعت نرم‌افزار تبدیل شده است.",
        ),
        new OA\Property(
            property: "category_id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "image",
            description: "Post image",
            type: "string",
            format: "binary"
        ),
        new OA\Property(
            property: "commentable",
            type: "integer",
            example: 1,
            enum: [0, 1]
        ),
        new OA\Property(
            property: "published_at",
            description: "Unix timestamp",
            type: "integer",
            example: 1782331200
        ),
        new OA\Property(
            property: "tags",
            type: "string",
            example: "هوش مصنوعی-فناوری-برنامه نویسی-AI-تکنولوژی"
        ),
        new OA\Property(
            property: "status",
            description: "Post status (optional)",
            type: "integer",
            example: 1,
            enum: [0, 1]
        ),
    ]
)]
class PostStoreRequest
{

}
