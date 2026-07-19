<?php

namespace App\OpenApi\Paths\Customer\Market\Product;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/product/{id}",
    description: "Show a product by its ID.",
    summary: "Show product details",
    tags: ["Customer/Market/Product"],
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
            description: "Product retrieved successfully.",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "success",
                        type: "boolean",
                        example: true
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/ProductDetails"
                    )
                ],
                type: "object"
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
            description: "Product not found",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ModelNotFoundError"
            )
        )
    ]
)]
class Product
{

}
