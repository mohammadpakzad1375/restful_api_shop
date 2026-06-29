<?php

namespace App\OpenApi\Paths\Admin\Setting;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/admin/setting',
    description: 'Retrieve setting',
    security: [['sanctumAuth' => []]],
    tags: ['Admin/Setting'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Setting retrieved successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'success',
                        type: 'boolean',
                        example: true
                    ),
                    new OA\Property(
                        property: 'data',
                        ref: "#/components/schemas/Setting"
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
