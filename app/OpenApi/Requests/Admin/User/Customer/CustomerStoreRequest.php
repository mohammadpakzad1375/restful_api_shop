<?php

namespace App\OpenApi\Requests\Admin\User\Customer;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CustomerStoreRequest",
    required: [
        "first_name",
        "last_name",
        "mobile",
        "email",
        "national_code",
        "password",
        "password_confirmation",
        "status"
    ],
    properties: [
        new OA\Property(
            property: "first_name",
            type: "string",
            example: "mohammad",
        ),
        new OA\Property(
            property: "last_name",
            type: "string",
            example: "pakzad",
        ),
        new OA\Property(
            property: "mobile",
            type: "string",
            example: "09130139244"
        ),
        new OA\Property(
            property: "national_code",
            type: "string",
            example: "4568136789"
        ),
        new OA\Property(
            property: "email",
            type: "string",
            format: "email",
            example: "mohammad@example.com"
        ),
        new OA\Property(
            property: "password",
            description: "Minimum 8 characters, including uppercase, lowercase, number and symbol.",
            type: "string",
            format: "password",
            example: "Password@123"
        ),
        new OA\Property(
            property: "password_confirmation",
            type: "string",
            format: "password",
            example: "Password@123"
        ),
        new OA\Property(
            property: "profile_photo_path",
            type: "string",
            format: "binary",
            nullable: true
        ),
        new OA\Property(
            property: "status",
            description: "0 = Inactive, 1 = Active",
            type: "integer",
            example: 1,
            enum: [0, 1]
        ),
    ]

)]
class CustomerStoreRequest
{

}
