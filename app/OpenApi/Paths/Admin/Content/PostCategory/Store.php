<?php

namespace App\OpenApi\Paths\Admin\Content\PostCategory;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/admin/content/category",
    summary: "Create Post Category",
    security: [['sanctumAuth' => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\MediaType(
            mediaType: "multipart/form-data",
            schema: new OA\Schema(
                ref: "#/components/schemas/PostCategoryStoreRequest"
            )
        )
    ),
    tags: ["Admin/Content/Post Category"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Post category created successfully",
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
                        example: "PostCategory created successfully."
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/PostCategory"
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
