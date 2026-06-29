<?php

namespace App\OpenApi\Requests\Admin\Auth;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "AdminLoginRequest",
    required: ["email", "password"],
    properties: [
        new OA\Property(
            property: "email",
            type: "string",
            format: "email",
            example: "mohammad_pakzad@gmail.com"
        ),
        new OA\Property(
            property: "password",
            type: "string",
            format: "password",
            example: "Password@123"
        ),
    ]
)]
class LoginRequest
{

}
