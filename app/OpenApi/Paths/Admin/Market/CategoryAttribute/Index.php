<?php

namespace App\OpenApi\Paths\Admin\Market\CategoryAttribute;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/admin/market/category-attribute/category/{id}',
    description: 'Retrieve list of a category attributes.',
    summary: 'List Category Attributes',
    security: [['sanctumAuth' => []]],
    tags: ['Admin/Market/CategoryAttribute'],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Category ID",
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
            description: 'Category attribute retrieved successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'success',
                        type: 'boolean',
                        example: true
                    ),
                    new OA\Property(
                        property: 'data',
                        type: 'array',
                        items: new OA\Items(
                            ref: "#/components/schemas/CategoryAttribute"
                        )
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
            response: 403,
            description: "Forbidden",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ForbiddenError"
            )
        ),
        new OA\Response(
            response: 404,
            description: "Category not found",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ModelNotFoundError"
            )
        )
    ]
)]
class Index
{

}
