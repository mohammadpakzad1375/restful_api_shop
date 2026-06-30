<?php

namespace App\OpenApi\Paths\Admin\Market\ProductCategory;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/admin/market/category',
    description: 'Retrieve a paginated list of product categories.',
    summary: 'List Product Categories',
    security: [['sanctumAuth' => []]],
    tags: ['Admin/Market/Product Category'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Product categories retrieved successfully',
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
                            ref: "#/components/schemas/ProductCategory"
                        )
                    ),
                    new OA\Property(
                        property: "meta",
                        ref: "#/components/schemas/PaginationMeta"
                    ),
                    new OA\Property(
                        property: "links",
                        ref: "#/components/schemas/PaginationLinks"
                    ),
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
    ]
)]
#[OA\Parameter(
    name: 'page',
    description: 'Page number',
    in: 'query',
    required: false,
    schema: new OA\Schema(
        type: 'integer',
        default: 1
    )
)]
class Index
{

}
