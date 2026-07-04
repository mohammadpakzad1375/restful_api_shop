<?php

namespace App\OpenApi\Paths\Admin\Market\Storage;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/admin/market/storage/add-to-storage",
    description: "Add product to storage by its ID.",
    summary: "Add Product To Storage",
    security: [['sanctumAuth' => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            ref: "#/components/schemas/AddToStorageRequest"
        )
    ),
    tags: ["Admin/Market/Storage"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Product ID",
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
            response: 201,
            description: "Add product to storage successfully",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "success",
                        type: "boolean",
                        example: true
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/Product"
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
            description: "Product not found",
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
class AddToStorage
{

}
