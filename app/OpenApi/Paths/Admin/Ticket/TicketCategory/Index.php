<?php

namespace App\OpenApi\Paths\Admin\Ticket\TicketCategory;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/admin/ticket/category',
    description: 'Retrieve list of Ticket categories.',
    summary: 'List Ticket categories',
    security: [['sanctumAuth' => []]],
    tags: ['Admin/Ticket/TicketCategory'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Ticket categories retrieved successfully',
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
                            ref: "#/components/schemas/TicketCategory"
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
    ]
)]
class Index
{

}
