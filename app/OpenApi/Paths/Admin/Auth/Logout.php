<?php

namespace App\OpenApi\Paths\Admin\Auth;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/admin/auth/logout",
    description: "Logout the authenticated admin and revoke the current Sanctum access token.",
    summary: "Admin Logout",
    security: [["sanctumAuth" => []]],
    tags: ["Admin/Auth/Login"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Successfully logged in",
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
                        example: "Successfully logged out."
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
        )
    ]
)]
class Logout
{

}
