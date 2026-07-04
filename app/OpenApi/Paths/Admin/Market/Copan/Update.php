<?php

namespace App\OpenApi\Paths\Admin\Market\Copan;

use OpenApi\Attributes as OA;
#[OA\Patch(
    path: "/api/admin/market/copan/{id}",
    description: "Update a copan by its ID.",
    summary: "Update a copan",
    security: [["sanctumAuth" => []]],
    requestBody: new OA\RequestBody(
        required: false,
        content: new OA\JsonContent(
            ref: "#/components/schemas/CopanUpdateRequest"
        )
    ),
    tags: ["Admin/Market/Copan"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Copan ID",
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
            description: "Copan updated successfully",
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
                        example: "Copan updated successfully."
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/AmazingSale"
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
            description: "Copan not found",
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
