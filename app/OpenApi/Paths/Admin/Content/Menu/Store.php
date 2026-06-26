<?php

namespace App\OpenApi\Paths\Admin\Content\Menu;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/admin/content/menu",
    summary: "Create menu",
    security: [["sanctumAuth" => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            ref: "#/components/schemas/MenuStoreRequest"
        )
    ),
    tags: ["Admin/Content/Menu"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Menu created successfully",
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
                        example: "Menu created successfully."
                    ),
                    new OA\Property(
                        property: "data",
                        properties: [
                            new OA\Property(
                                property: "id",
                                type: "integer",
                                example: 1),
                            new OA\Property(
                                property: "name",
                                type: "string",
                                example: "درباره ما"
                            ),
                            new OA\Property(
                                property: "url",
                                type: "string",
                                example: "https://example.com/about"
                            ),
                            new OA\Property(
                                property: "parent",
                                type: "integer",
                                example: 1,
                                nullable: true
                            )
                        ],
                        type: "object"
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
