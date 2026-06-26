<?php

namespace App\OpenApi\Paths\Admin\Content\Faq;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/admin/content/faq/{id}",
    description: "Show a FAQ by its ID.",
    summary: "Show FAQ details",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Content/FAQ"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "FAQ ID",
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
            description: "FAQ details retrieved successfully",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "success",
                        type: "boolean",
                        example: true
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/FAQ"
                    )
                ],
                type: "object"
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
            response: 403,
            description: "Forbidden",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ForbiddenError"
            )
        ),
        new OA\Response(
            response: 404,
            description: "FAQ not found",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ModelNotFoundError"
            )
        )
    ]
)]
class Show
{

}
