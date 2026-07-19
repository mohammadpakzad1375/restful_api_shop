<?php

namespace App\OpenApi\Paths\Customer\Market\Product;

use OpenApi\Attributes as OA;
#[OA\Patch(
    path: "/api/product/add-comment/{id}",
    description: "Create a comment for a product by its ID.",
    summary: "Create a product comment",
    security: [["jwtAuth" => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: [
                'body'
            ],
            properties:[
                new OA\Property(
                    property: "body",
                    type: "string",
                    example: "خیلی عالی است.",
                ),
                new OA\Property(
                    property: "parent_id",
                    type: "integer",
                    example: "1",
                    nullable: true
                )
            ]
        )
    ),
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
            description: "Product comment created successfully.",
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
                        example: "Product comment created successfully."
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
        )
    ]
)]
class AddComment
{

}
