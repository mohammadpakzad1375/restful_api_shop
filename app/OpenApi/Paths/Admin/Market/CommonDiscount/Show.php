<?php

namespace App\OpenApi\Paths\Admin\Market\CommonDiscount;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/admin/market/common-discount/{id}",
    description: "Show a common discount by its ID.",
    summary: "Show common discount details",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Market/CommonDiscount"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Common Discount ID",
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
            description: "Common discount details retrieved successfully",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "success",
                        type: "boolean",
                        example: true
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/CommonDiscount"
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
            description: "Common discount not found",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ModelNotFoundError"
            )
        )
    ]
)]
class Show
{

}
