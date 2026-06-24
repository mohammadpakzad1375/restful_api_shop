<?php

namespace App\OpenApi\Schemas\HttpErrors;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ModelNotFoundError",
    properties: [
        new OA\Property(
            property: 'success',
            type: 'boolean',
            example: false
        ),
        new OA\Property(
            property: "message",
            type: "string",
            example: "Resource not found."
        )
    ],
    type: "object"
)]
class ModelNotFoundErrorSchema
{

}
