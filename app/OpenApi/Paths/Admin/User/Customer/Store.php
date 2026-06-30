<?php

namespace App\OpenApi\Paths\Admin\User\Customer;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/admin/user/customer",
    summary: "Create Customer",
    security: [['sanctumAuth' => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\MediaType(
            mediaType: "multipart/form-data",
            schema: new OA\Schema(
                ref: "#/components/schemas/CustomerStoreRequest"
            )
        )
    ),
    tags: ["Admin/User/Customer"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Customer created successfully",
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
                        example: "Customer created successfully."
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/Customer"
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
