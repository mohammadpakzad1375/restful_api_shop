<?php

namespace App\OpenApi\Schemas\Admin\Market\Comment;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductCommentDetails",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1),
        new OA\Property(
            property: "body",
            type: "string",
            example: "این محصول کیفیت بسیار خوبی دارد."
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
            property: "product",
            ref: "#/components/schemas/Product"
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
