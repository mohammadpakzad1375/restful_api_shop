<?php

namespace App\OpenApi\Paths\Customer\Auth;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/customer/auth/logout-all-devices",
    description: "Logout the authenticated customer user in all devices and revoke the current access token and refresh token.",
    summary: "Customer Logout In All Devices",
    security: [["jwtAuth" => []]],
    tags: ["Customer/Auth"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Successfully logged out in all devices.",
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
                        example: "Successfully logged out in all devices."
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
class LogoutAllDevices
{

}
