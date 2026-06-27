<?php

namespace App\OpenApi\Paths\Admin\Notify\Notification;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/admin/notify/notification/unread',
    description: 'Retrieve list of unread notifications.',
    summary: 'List unread notifications',
    security: [['sanctumAuth' => []]],
    tags: ['Admin/Notify/Notification'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Unread Notifications retrieved successfully',
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
                            ref: "#/components/schemas/Notification"
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
class Unread
{

}
