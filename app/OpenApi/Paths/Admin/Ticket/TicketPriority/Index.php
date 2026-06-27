<?php

namespace App\OpenApi\Paths\Admin\Ticket\TicketPriority;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/admin/ticket/priority',
    description: 'Retrieve list of Ticket priorities.',
    summary: 'List Ticket priorities',
    security: [['sanctumAuth' => []]],
    tags: ['Admin/Ticket/TicketPriority'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Ticket priorities retrieved successfully',
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
                            ref: "#/components/schemas/TicketPriority"
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
