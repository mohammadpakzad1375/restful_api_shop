<?php

namespace App\OpenApi\Paths\Admin\Market\Brand;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/admin/market/brand",
    summary: "Create Brand",
    security: [['sanctumAuth' => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\MediaType(
            mediaType: "multipart/form-data",
            schema: new OA\Schema(
                ref: "#/components/schemas/BrandStoreRequest"
            )
        )
    ),
    tags: ["Admin/Market/Brand"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Brand created successfully",
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
                        example: "Brand created successfully."
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
            response: 403,
            description: "Forbidden",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ForbiddenError"
            )
        ),
    ]
)]
class Store
{

}
