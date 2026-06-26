<?php

namespace App\OpenApi\Paths\Admin\Content\Faq;

use OpenApi\Attributes as OA;

#[OA\Patch(
    path: "/api/admin/content/faq/{id}",
    description: "Update a FAQ by its ID.",
    summary: "Update a FAQ",
    security: [["sanctumAuth" => []]],
    requestBody: new OA\RequestBody(
        required: false,
        content: new OA\JsonContent(
            ref: "#/components/schemas/FaqUpdateRequest"
        )
    ),
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
            description: "FAQ updated successfully",
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
                        example: "FAQ updated successfully."
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/FAQ"
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
            response: 422,
            description: "Validation Error",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ValidationError"
            )
        ),
        new OA\Response(
            response: 404,
            description: "FAQ not found",
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
class Update
{

}
