<?php

namespace App\OpenApi\Paths\Admin\Ticket\TicketPriority;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/admin/ticket/priority/{id}",
    description: "Show a ticket priority by its ID.",
    summary: "Show ticket priority details",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Ticket/TicketPriority"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Page ID",
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
            description: "Ticket priority details retrieved successfully",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "success",
                        type: "boolean",
                        example: true
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/TicketPriority"
                    )
                ],
                type: "object"
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
            description: "Ticket priority not found",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ModelNotFoundError"
            )
        )
    ]
)]
class Show
{

}
