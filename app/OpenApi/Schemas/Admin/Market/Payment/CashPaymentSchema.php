<?php

namespace App\OpenApi\Schemas\Admin\Market\Payment;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CashPayment",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "cash_receiver",
            type: "string",
            example: "حسن جعفری"
        ),
        new OA\Property(
            property: "pay_date",
            type: "string",
            format: "date-time",
            example: "2026-07-04 17:09:04"
        )
    ],
    type: "object"
)]
class CashPaymentSchema
{

}
