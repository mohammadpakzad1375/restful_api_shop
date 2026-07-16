<?php

namespace App\OpenApi\Schemas\User\Customer;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Customer",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1),
        new OA\Property(
            property: "first_name",
            type: "string",
            example: "mohammad"
        ),
        new OA\Property(
            property: "last_name",
            type: "string",
            example: "pakzad"
        ),
        new OA\Property(
            property: "full_name",
            type: "string",
            example: "mohammad pakzad"
        ),
        new OA\Property(
            property: "user_type",
            type: "integer",
            example: 0,
            enum: [0],
        ),
        new OA\Property(
            property: "email",
            type: "string",
            example: "mohammad.pakzad1375@gmail.com"
        ),
        new OA\Property(
            property: "mobile",
            type: "string",
            example: "09130139244"
        ),
        new OA\Property(
            property: "national_code",
            type: "string",
            example: "1861357869"
        ),
        new OA\Property(
            property: "profile_photo_path",
            type: "string",
            example: "null",
            nullable: true
        ),
    ],
    type: "object"
)]
class CustomerSchema
{

}
