<?php

namespace App\OpenApi\Paths\Admin\User\Customer;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/admin/user/customer/{id}",
    description: "Show a customer by its ID.",
    summary: "Show customer details",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/User/Customer"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Customer ID",
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
            description: "Customer details retrieved successfully",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "success",
                        type: "boolean",
                        example: true
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/Customer"
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
            description: "Customer not found",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ModelNotFoundError"
            )
        )
    ]
)]
class Show
{

}
