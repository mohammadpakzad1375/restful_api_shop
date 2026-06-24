<?php

namespace App\OpenApi\Schemas\HttpErrors;


use OpenApi\Attributes as OA;


#[OA\Schema(
    schema: "ValidationError",
    properties: [
        new OA\Property(
            property: 'success',
            type: 'boolean',
            example: false
        ),
        new OA\Property(
            property: "message",
            type: "string",
            example: "Validation failed."
        ),
        new OA\Property(
            property: "errors",
            type: "object",
            additionalProperties: new OA\AdditionalProperties(
                type: "array",
                items: new OA\Items(type: "string")
            )
        ),
    ],
    type: "object"
)]
class ValidationErrorSchema
{

}
