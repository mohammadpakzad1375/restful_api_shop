<?php

namespace App\OpenApi\Paths\Admin\Market\AttributeValue;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/admin/market/category-attribute/value",
    summary: "Create Attribute Value",
    security: [['sanctumAuth' => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            ref: "#/components/schemas/AttributeValueStoreRequest"
        )
    ),
    tags: ["Admin/Market/AttributeValue"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Attribute value created successfully",
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
                        example: "AttributeValue created successfully."
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/AttributeValue"
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
