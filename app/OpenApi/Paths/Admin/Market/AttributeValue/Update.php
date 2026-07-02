<?php

namespace App\OpenApi\Paths\Admin\Market\AttributeValue;

use OpenApi\Attributes as OA;
#[OA\Patch(
    path: "/api/admin/market/category-attribute/value/{id}",
    description: "Update an attribute value by its ID.",
    summary: "Update an attribute value",
    security: [["sanctumAuth" => []]],
    requestBody: new OA\RequestBody(
        required: false,
        content: new OA\JsonContent(
            ref: "#/components/schemas/AttributeValueUpdateRequest"
        )
    ),
    tags: ["Admin/Market/AttributeValue"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Attribute Value ID",
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
            description: "Attribute value updated successfully",
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
                        example: "AttributeValue updated successfully."
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
            response: 404,
            description: "Attribute value not found",
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
class Update
{

}
