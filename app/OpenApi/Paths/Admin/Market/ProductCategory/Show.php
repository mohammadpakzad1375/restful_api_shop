<?php

namespace App\OpenApi\Paths\Admin\Market\ProductCategory;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/admin/market/category/{id}",
    description: "Show a product category by its ID.",
    summary: "Show product category details",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Content/Post Category"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Product category ID",
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
            description: "Product category details retrieved successfully",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "success",
                        type: "boolean",
                        example: true
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/ProductCategoryDetails"
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
            description: "Product category not found",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ModelNotFoundError"
            )
        )
    ]
)]
class Show
{

}
