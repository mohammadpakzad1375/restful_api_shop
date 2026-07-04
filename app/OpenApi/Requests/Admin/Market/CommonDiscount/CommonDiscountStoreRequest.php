<?php

namespace App\OpenApi\Requests\Admin\Market\CommonDiscount;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CommonDiscountStoreRequest",
    required: [
        'title',
        'percentage',
        'start_date',
        'end_date',
    ],
    properties: [
        new OA\Property(
            property: 'title',
            type: 'string',
            example: 'تخفیف ویژه تابستان',
        ),
        new OA\Property(
            property: 'percentage',
            type: 'integer',
            example: 20,
            maximum: 100,
            minimum: 1
        ),
        new OA\Property(
            property: 'discount_ceiling',
            type: 'integer',
            example: 500000,
            nullable: true
        ),
        new OA\Property(
            property: 'minimum_order_amount',
            type: 'integer',
            example: 1000000,
            nullable: true
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
    ]
)]
class CommonDiscountStoreRequest
{

}
