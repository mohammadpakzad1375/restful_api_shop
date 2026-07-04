<?php

namespace App\OpenApi\Paths\Admin\Market\AmazingSale;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/admin/market/amazing-sale/{id}",
    description: "Show a amazing sale by its ID.",
    summary: "Show amazing sale details",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Market/AmazingSale"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Amazing Sale ID",
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
            description: "Amazing sale details retrieved successfully",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "success",
                        type: "boolean",
                        example: true
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/AmazingSaleDetails"
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
            description: "Amazing sale not found",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ModelNotFoundError"
            )
        )
    ]
)]
class Show
{

}
