<?php

namespace App\OpenApi\Schemas\Content\Comment;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Comment",
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
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "post",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "parent",
            example: null,
            nullable: true
        )
    ],
    type: "object"
)]
class CommentSchema
{

}
