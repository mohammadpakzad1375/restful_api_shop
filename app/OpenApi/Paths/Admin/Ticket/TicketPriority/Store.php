<?php

namespace App\OpenApi\Paths\Admin\Ticket\TicketPriority;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/admin/ticket/priority",
    summary: "Create Ticket priority",
    security: [["sanctumAuth" => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            ref: "#/components/schemas/TicketPriorityStoreRequest"
        )
    ),
    tags: ["Admin/Ticket/TicketPriority"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Ticket priority created successfully",
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
                        example: "TicketPriority created successfully."
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/TicketPriority"
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
