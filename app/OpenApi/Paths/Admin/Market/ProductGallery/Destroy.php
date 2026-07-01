<?php

namespace App\OpenApi\Paths\Admin\Market\ProductGallery;

use OpenApi\Attributes as OA;

#[OA\Delete(
    path: "/api/admin/market/product/gallery/{id}",
    description: "Delete a product gallery by its ID.",
    summary: "Delete a product gallery",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Market/ProductGallery"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Product Gallery ID",
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
            description: "Product gallery deleted successfully",
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
                        example: "ProductGallery deleted successfully."
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
            response: 404,
            description: "Product gallery not found",
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
class Destroy
{

}
