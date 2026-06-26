<?php

namespace App\OpenApi\Schemas\Admin\Content\Comment;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CommentDetails",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1),
        new OA\Property(
            property: "body",
            type: "string",
            example: "این یک کامنت آزمایشی است."
        ),
        new OA\Property(
            property: "seen",
            type: "integer",
            example: 1,
            enum: [0, 1]
        ),
        new OA\Property(
            property: "approved",
            type: "integer",
            example: 1,
            enum: [0, 1]
        ),
        new OA\Property(
            property: "status",
            type: "integer",
            example: 1,
            enum: [0, 1]
        ),
        new OA\Property(
            property: "author",
            properties: [
                new OA\Property(
                    property: "id",
                    type: "integer",
                    example: 1),
                new OA\Property(
                    property: "email",
                    type: "string",
                    example: "mohammad.pakzad1375@gmail.com"
                ),
                new OA\Property(
                    property: "national_code",
                    type: "string",
                    example: "1861357869"
                ),
                new OA\Property(
                    property: "first_name",
                    type: "string",
                    example: "mohammad"
                ),
                new OA\Property(
                    property: "last_name",
                    type: "string",
                    example: "pakzad"
                ),
                new OA\Property(
                    property: "profile_photo_path",
                    type: "string",
                    example: "null",
                    nullable: true
                ),
                new OA\Property(
                    property: "user_type",
                    type: "integer",
                    example: "1",
                    enum: [0,1]
                )
            ],
            type: "object"
        ),
        new OA\Property(
            property: "post",
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
        ),
        new OA\Property(
            property: "parent",
            example: null,
            nullable: true
        ),
        new OA\Property(
            property: "answers",
            type: "array",
            items: new OA\Items(
                type: "object"
            ),
            example: []
        )
    ],
    type: "object"
)]
class CommentDetailsSchema
{

}
