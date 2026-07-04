<?php

namespace App\OpenApi\Requests\Admin\Market\Storage;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "AddToStorageRequest",
    required: [
        "receiver",
        "deliverer",
        "marketable_number"
    ],
    properties: [
        new OA\Property(
            property: "receiver",
            type: "string",
            example: "علی رضایی"
        ),
        new OA\Property(
            property: "deliverer",
            type: "string",
            example: "محمد احمدی"
        ),
        new OA\Property(
            property: "marketable_number",
            type: "integer",
            example: 30
        ),
        new OA\Property(
            property: "description",
            type: "string",
            example: "تحویل کالا به انبار مرکزی"
        ),
    ]
)]
class AddToStorageRequest
{

}
