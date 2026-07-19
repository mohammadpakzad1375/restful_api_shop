<?php

namespace App\OpenApi\Schemas\Market\Comment;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductComment",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1),
        new OA\Property(
            property: "body",
            type: "string",
            example: "این محصول کیفیت بسیار خوبی دارد. "
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
            property: "author",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "product",
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
