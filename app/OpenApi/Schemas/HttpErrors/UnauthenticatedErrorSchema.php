<?php

namespace App\OpenApi\Schemas\HttpErrors;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "UnauthenticatedError",
    properties: [
        new OA\Property(
            property: 'success',
            type: 'boolean',
            example: false
        ),
        new OA\Property(
            property: "message",
            type: "string",
            example: "Unauthenticated."
        )
    ],
    type: "object"
)]
class UnauthenticatedErrorSchema
{

}
