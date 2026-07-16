<?php

namespace App\OpenApi\Schemas\Content\Comment;


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
            ref: "#/components/schemas/User"
        ),
        new OA\Property(
            property: "post",
            ref: "#/components/schemas/PostComment"
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
