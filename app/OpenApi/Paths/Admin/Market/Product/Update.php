<?php

namespace App\OpenApi\Paths\Admin\Market\Product;

use OpenApi\Attributes as OA;
#[OA\Patch(
    path: "/api/admin/market/product/{id}",
    description: "Update a product by its ID.",
    summary: "Update a product",
    security: [["sanctumAuth" => []]],
    requestBody: new OA\RequestBody(
        required: false,
        content: new OA\MediaType(
            mediaType: "multipart/form-data",
            schema: new OA\Schema(
                ref: "#/components/schemas/ProductUpdateRequest"
            )
        )
    ),
    tags: ["Admin/Market/Product"],
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
            response: 200,
            description: "Product updated successfully",
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
                        example: "Product updated successfully."
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
class Update
{

}
