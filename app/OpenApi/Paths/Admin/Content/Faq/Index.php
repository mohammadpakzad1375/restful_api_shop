<?php

namespace App\OpenApi\Paths\Admin\Content\Faq;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/admin/content/faq',
    description: 'Retrieve list of FAQs.',
    summary: 'List FAQs',
    security: [['sanctumAuth' => []]],
    tags: ['Admin/Content/FAQ'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'FAQs retrieved successfully',
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
                            ref: "#/components/schemas/FAQ"
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
