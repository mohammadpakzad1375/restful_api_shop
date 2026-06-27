<?php

namespace App\OpenApi\Paths\Admin\Notify\Email;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/admin/notify/email/{id}",
    description: "Show a email by its ID.",
    summary: "Show email details",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Notify/Email"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Email ID",
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
            description: "Email details retrieved successfully",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "success",
                        type: "boolean",
                        example: true
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/Email"
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
            description: "Email not found",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ModelNotFoundError"
            )
        )
    ]
)]
class Show
{

}
