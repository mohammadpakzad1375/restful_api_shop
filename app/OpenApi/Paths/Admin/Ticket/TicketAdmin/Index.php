<?php

namespace App\OpenApi\Paths\Admin\Ticket\TicketAdmin;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/admin/ticket/admin',
    description: 'Retrieve a paginated list of Ticket admins.',
    summary: 'List Ticket admins',
    security: [['sanctumAuth' => []]],
    tags: ['Admin/Ticket/TicketAdmin'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Ticket admins retrieved successfully',
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
                            ref: "#/components/schemas/Admin"
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
