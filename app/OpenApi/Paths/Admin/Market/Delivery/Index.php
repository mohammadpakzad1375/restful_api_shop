<?php

namespace App\OpenApi\Paths\Admin\Market\Delivery;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/admin/market/delivery',
    description: 'Retrieve a paginated list of deliveries.',
    summary: 'List Deliveries',
    security: [['sanctumAuth' => []]],
    tags: ['Admin/Market/Delivery'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'deliveries retrieved successfully',
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
                            ref: "#/components/schemas/Delivery"
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
