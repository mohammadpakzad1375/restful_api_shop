<?php

namespace App\OpenApi\Requests\Admin\Auth;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "AdminChangePasswordRequest",
    required: ["current_password", "password", "password_confirmation"],
    properties: [
        new OA\Property(
            property: "current_password",
            description: "Current account password",
            type: "string",
            example: "CurrentPassword@123"
        ),
        new OA\Property(
            property: "password",
            description: "Minimum 8 characters, must contain uppercase, lowercase, number and special character.",
            type: "string",
            example: "NewPassword@123",
            minLength: 8
        ),
        new OA\Property(
            property: "password_confirmation",
            description: "Must match the password field.",
            type: "string",
            example: "NewPassword@123"
        ),
    ]
)]
class ChangePasswordRequest
{

}
