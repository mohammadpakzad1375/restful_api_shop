<?php

namespace App\OpenApi\Paths\Admin\Ticket\Ticket;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/admin/ticket/answer/{id}",
    summary: "Answer ticket",
    security: [["sanctumAuth" => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['description'],
            properties: [
                new OA\Property(
                    property: 'description',
                    type: 'string'
                )
            ]
        )
    ),
    tags: ["Admin/Ticket/Ticket"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Ticket created successfully.",
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
                        example: "Ticket created successfully."
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/AnswerTicket"
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
        new OA\Response(
            response: 404,
            description: "Ticket not found",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ModelNotFoundError"
            )
        )
    ]
)]
class answer
{

}
