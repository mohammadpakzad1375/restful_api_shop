<?php

namespace App\OpenApi\Paths\Admin\Auth;

use OpenApi\Attributes as OA;

#[OA\Patch(
    path: "/api/admin/auth/change-password",
    description: "Change password an admin user.",
    summary: "Change Admin Password",
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            ref: "#/components/schemas/AdminChangePasswordRequest"
        )
    ),
    tags: ["Admin/Auth"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Password changed successfully",
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
                        example: "Password changed successfully."
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
            response: 422,
            description: "Validation Error",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ValidationError"
            )
        )
    ]
)]
class ChangePassword
{

}
