<?php

namespace App\OpenApi\Paths\Admin\Notify\Notification;

use OpenApi\Attributes as OA;

#[OA\Delete(
    path: "/api/admin/notify/notification/delete",
    description: "Delete all notifications.",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Notify/Notification"],
    responses: [
        new OA\Response(
            response: 200,
            description: "All notifications deleted successfully.",
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
                        example: "All notifications deleted successfully."
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
class Destroy
{

}
