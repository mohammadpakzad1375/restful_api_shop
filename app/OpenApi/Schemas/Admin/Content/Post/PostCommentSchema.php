<?php

namespace App\OpenApi\Schemas\Admin\Content\Post;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PostComment",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1),
        new OA\Property(
            property: "title",
            type: "string",
            example: "هوش مصنوعی چگونه آینده توسعه نرم‌افزار را متحول می‌کند؟"
        ),
        new OA\Property(
            property: "summary",
            type: "string",
            example: "هوش مصنوعی در حال تغییر روش توسعه، تست و نگهداری نرم‌افزارها است."
        ),
        new OA\Property(
            property: "body",
            type: "string",
            example: "هوش مصنوعی در حال تغییر روش توسعه، تست و نگهداری نرم‌افزارها است."
        ),
        new OA\Property(
            property: "image",
            type: "string",
            example: "images/post/2026/06/24/image.png"
        ),
        new OA\Property(
            property: "commentable",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "published_at",
            type: "string",
            example: "2026-06-24 23:00:00"
        ),
        new OA\Property(
            property: "author",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "category",
            type: "integer",
            example: 1
        )
    ],
    type: "object"
)]
class PostCommentSchema
{

}
