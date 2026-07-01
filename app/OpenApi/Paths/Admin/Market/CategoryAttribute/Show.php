<?php

namespace App\OpenApi\Paths\Admin\Market\CategoryAttribute;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/admin/market/category-attribute/{id}",
    description: "Show a category attribute by its ID.",
    summary: "Show category attribute details",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Market/CategoryAttribute"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Category Attribute ID",
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
            description: "Category attribute details retrieved successfully",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "success",
                        type: "boolean",
                        example: true
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/CategoryAttribute"
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
            description: "Category attribute not found",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ModelNotFoundError"
            )
        )
    ]
)]
class Show
{

}
