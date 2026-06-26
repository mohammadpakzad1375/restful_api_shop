<?php

namespace App\OpenApi\Paths\Admin\Content\Menu;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/admin/content/menu',
    description: 'Retrieve a paginated list of menus.',
    summary: 'List menus',
    security: [['sanctumAuth' => []]],
    tags: ['Admin/Content/Menu'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Menus retrieved successfully',
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
                            properties: [
                                new OA\Property(
                                    property: "id",
                                    type: "integer",
                                    example: 1),
                                new OA\Property(
                                    property: "name",
                                    type: "string",
                                    example: "درباره ما"
                                ),
                                new OA\Property(
                                    property: "url",
                                    type: "string",
                                    example: "https://example.com/about"
                                ),
                                new OA\Property(
                                    property: "parent",
                                    type: "integer",
                                    example: 1,
                                    nullable: true
                                )
                            ],
                            type: "object"
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
