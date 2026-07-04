<?php

namespace App\OpenApi\Requests\Admin\Market\AmazingSale;

use OpenApi\Attributes as OA;
#[OA\Schema(
    schema: "AmazingSaleStoreRequest",
    required: [
        'percentage',
        'start_date',
        'end_date',
        'product_id'
    ],
    properties: [
        new OA\Property(
            property: 'percentage',
            type: 'integer',
            example: 20,
            maximum: 100,
            minimum: 1
        ),
        new OA\Property(
            property: 'start_date',
            description: 'Unix timestamp',
            type: 'integer',
            example: 1783180800
        ),
        new OA\Property(
            property: 'end_date',
            description: 'Unix timestamp',
            type: 'integer',
            example: 1785772800
        ),
        new OA\Property(
            property: "product_id",
            type: "integer",
            example: 1
        )
    ]
)]
class AmazingSaleStoreRequest
{

}
