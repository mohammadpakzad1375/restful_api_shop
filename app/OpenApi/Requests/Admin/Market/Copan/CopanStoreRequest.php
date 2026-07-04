<?php

namespace App\OpenApi\Requests\Admin\Market\Copan;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CopanStoreRequest",
    required: [
        "amount",
        "amount_type",
        "start_date",
        "end_date"
    ],
    properties: [
        new OA\Property(
            property: "amount",
            type: "integer",
            example: 50000
        ),
        new OA\Property(
            property: "amount_type",
            description: "1: مبلغ ثابت، 0: درصد",
            type: "integer",
            example: 1,
            enum: [0, 1]
        ),
        new OA\Property(
            property: "discount_ceiling",
            type: "integer",
            example: 200000,
            nullable: true
        ),
        new OA\Property(
            property: "user_id",
            description: "شناسه کاربر. در صورت null، کد تخفیف عمومی خواهد بود.",
            type: "integer",
            example: 15,
            nullable: true
        ),
        new OA\Property(
            property: "start_date",
            description: "Unix timestamp",
            type: "integer",
            example: 1783180800
        ),
        new OA\Property(
            property: "end_date",
            description: "Unix timestamp",
            type: "integer",
            example: 1785772800
        ),
        new OA\Property(
            property: "status",
            description: "0: غیرفعال، 1: فعال",
            type: "integer",
            example: 1,
            enum: [0, 1]
        ),
    ]
)]
class CopanStoreRequest
{

}
