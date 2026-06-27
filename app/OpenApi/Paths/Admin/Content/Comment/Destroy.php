<?php

namespace App\OpenApi\Paths\Admin\Content\Comment;

use OpenApi\Attributes as OA;

#[OA\Delete(
    path: "/api/admin/content/comment/{id}",
    description: "Delete a comment by its ID.",
    summary: "Delete a comment",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Content/Comment"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Comment ID",
            in: "path",
            required: true,
            schema: new OA\Schema(
                type: "integer",
                example: 1
            )
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Comment deleted successfully",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "success",
                        type: "boolean",
                        example: true
                    ),
                    new OA\Property(
                        property: "message",
                        type: "string",
                        example: "Comment deleted successfully."
                    )
                ]
            )
        ),
        new OA\Response(
            response: 401,
            description: "Unauthenticated",
            content: new OA\JsonContent(
                ref: "#/components/schemas/UnauthenticatedError"
            )
        ),
        new OA\Response(
            response: 404,
            description: "Comment not found",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ModelNotFoundError"
            )
        ),
        new OA\Response(
            response: 403,
            description: "Forbidden",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ForbiddenError"
            )
        ),
    ]
)]
class Destroy
{

}
