<?php

namespace App\OpenApi\Paths\Admin\Ticket\TicketCategory;

use OpenApi\Attributes as OA;

#[OA\Delete(
    path: "/api/admin/ticket/category/{id}",
    description: "Delete a ticket category by its ID.",
    summary: "Delete a ticket category",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Ticket/TicketCategory"],
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
            description: "Ticket category deleted successfully",
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
                        example: "TicketCategory deleted successfully."
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
            response: 404,
            description: "Ticket category not found",
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
class Destroy
{

}
