<?php

namespace App\OpenApi\Paths\Admin\Market\ProductColor;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/admin/market/product/color",
    summary: "Create Product Color",
    security: [['sanctumAuth' => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            ref: "#/components/schemas/ProductColorStoreRequest"
        )
    ),
    tags: ["Admin/Market/ProductColor"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Product color created successfully",
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
                        example: "ProductColor created successfully."
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/ProductColor"
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
