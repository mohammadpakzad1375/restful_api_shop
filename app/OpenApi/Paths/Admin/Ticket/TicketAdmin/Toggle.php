<?php

namespace App\OpenApi\Paths\Admin\Ticket\TicketAdmin;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/admin/ticket/admin/toggle/{id}",
    summary: "Toggle Ticket Admin",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Ticket/TicketAdmin"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Admin User ID",
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
            description: "Ticket admin created successfully",
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
                        example: "TicketAdmin created successfully."
                    ),
                    new OA\Property(
                        property: "data",
                        properties: [
                            new OA\Property(
                                property: "user_id",
                                type: "integer",
                                example: 1
                            ),
                            new OA\Property(
                                property: "id",
                                type: "integer",
                                example: 3
                            ),
                        ],
                        type: "object"
                    )
                ]
            )
        ),
        new OA\Response(
            response: 200,
            description: "Ticket admin deleted successfully",
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
                        example: "TicketAdmin deleted successfully."
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
            description: "Admin not found",
            content: new OA\JsonContent(
                ref: "#/components/schemas/NotFoundError"
            )
        )
    ]
)]
class Toggle
{

}
