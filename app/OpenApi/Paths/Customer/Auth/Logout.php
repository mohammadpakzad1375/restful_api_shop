<?php

namespace App\OpenApi\Paths\Customer\Auth;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/customer/auth/logout",
    description: "Logout the authenticated customer user and revoke the current access token and refresh token.",
    summary: "Customer Logout",
    security: [["jwtAuth" => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: [
                'refresh_token'
            ],
            properties:[
                new OA\Property(
                    property: "refresh_token",
                    type: "string",
                    example: "77a559be00fe3a4a40afd2de555071e5c0c5ba03f869e43932f43388b566dddb",
                    maxLength: 64,
                    minLength: 64
                )
            ]
        )
    ),
    tags: ["Customer/Auth"],
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
