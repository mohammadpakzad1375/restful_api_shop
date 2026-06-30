<?php

namespace App\OpenApi\Paths\Admin\User\Customer;

use OpenApi\Attributes as OA;

#[OA\Delete(
    path: "/api/admin/user/customer/{id}",
    description: "Delete a customer by its ID.",
    summary: "Delete a customer",
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
            description: "Customer deleted successfully",
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
                        example: "Customer deleted successfully."
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
            description: "Customer not found",
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
