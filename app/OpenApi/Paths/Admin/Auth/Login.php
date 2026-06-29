<?php

namespace App\OpenApi\Paths\Admin\Auth;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/admin/auth/login",
    description: "Authenticate an admin user and return a Sanctum access token.",
    summary: "Admin Login",
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            ref: "#/components/schemas/AdminLoginRequest"
        )
    ),
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
                        example: "Successfully logged in."
                    ),
                    new OA\Property(
                        property: "token",
                        type: "string",
                        example: "2|4yAdP5FcBGQYGuFE6TniLjLH21UoleQSbs1mfa3W8bb80ed4"
                    ),
                    new OA\Property(
                        property: "data",
                        ref: "#/components/schemas/Admin"
                    ),
                ]
            )
        ),
        new OA\Response(
            response: 422,
            description: "Validation Error",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ValidationError"
            )
        )
    ]
)]
class Login
{

}
