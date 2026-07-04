<?php

namespace App\OpenApi\Paths\Admin\Market\Payment;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/admin/market/payment/cash',
    description: 'Retrieve a paginated list of cash payments.',
    summary: 'List Cash Payments',
    security: [['sanctumAuth' => []]],
    tags: ['Admin/Market/Payment'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Cash payments retrieved successfully',
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
                            ref: "#/components/schemas/Payment"
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
class Cash
{

}
