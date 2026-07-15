<?php

namespace App\OpenApi\Paths\Admin\Market\AmazingSale;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/admin/market/amazing-sale",
    summary: "Create Amazing Sale",
    security: [['sanctumAuth' => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            ref: "#/components/schemas/AmazingSaleStoreRequest"
        )
    ),
    tags: ["Admin/Market/AmazingSale"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Amazing sale created successfully",
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
                        example: "AmazingSale created successfully."
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
            response: 403,
            description: "Forbidden",
            content: new OA\JsonContent(
                oneOf: [
                    new OA\Schema(
                        ref: "#/components/schemas/ForbiddenError"
                    ),
                    new OA\Schema(
                        properties: [
                            new OA\Property(
                                property: 'success',
                                type: 'boolean',
                                example: false
                            ),
                            new OA\Property(
                                property: "message",
                                type: "string",
                                example: "This action is unauthorized, exists another active amazing sale for this product."
                            )
                        ],
                        type: "object"
                    )
                ]
            )
        ),
    ]
)]
class Store
{

}
