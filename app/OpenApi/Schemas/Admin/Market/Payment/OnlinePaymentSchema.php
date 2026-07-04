<?php

namespace App\OpenApi\Schemas\Admin\Market\Payment;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "OnlinePayment",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "gateway",
            type: "string",
            example: "ملت"
        ),
        new OA\Property(
            property: "transaction_id",
            type: "integer",
            example: 1654614247984,
            nullable: true
        ),
        new OA\Property(
            property: "pay_date",
            type: "string",
            format: "date-time",
            example: "2026-07-04 17:09:04"
        ),
        new OA\Property(
            property: "bank_first_response",
            type: "string",
            nullable: true
        ),
        new OA\Property(
            property: "bank_second_response",
            type: "string",
            nullable: true
        ),
    ],
    type: "object"
)]
class OnlinePaymentSchema
{

}
