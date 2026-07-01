<?php

namespace App\OpenApi\Paths\Admin\Market\Brand;

use OpenApi\Attributes as OA;
#[OA\Patch(
    path: "/api/admin/market/brand/{id}",
    description: "Update a brand by its ID.",
    summary: "Update a brand",
    security: [["sanctumAuth" => []]],
    requestBody: new OA\RequestBody(
        required: false,
        content: new OA\MediaType(
            mediaType: "multipart/form-data",
            schema: new OA\Schema(
                ref: "#/components/schemas/BrandUpdateRequest"
            )
        )
    ),
    tags: ["Admin/Market/Brand"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Brand ID",
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
            description: "Brand updated successfully",
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
                        example: "Brand updated successfully."
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/Brand"
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
            description: "Brand not found",
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
