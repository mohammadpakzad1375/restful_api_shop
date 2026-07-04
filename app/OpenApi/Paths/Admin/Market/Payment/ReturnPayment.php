<?php

namespace App\OpenApi\Paths\Admin\Market\Payment;

use OpenApi\Attributes as OA;

#[OA\Delete(
    path: "/api/admin/market/payment/return/{id}",
    description: "Return a payment by its ID.",
    summary: "Return Payment",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Market/Payment"],
    parameters: [
        new OA\Parameter(
            name: "id",
            description: "Payment ID",
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
            description: "Payment returned successfully",
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
                        example: "Payment returned successfully"
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
            description: "Payment not found",
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
class ReturnPayment
{

}
