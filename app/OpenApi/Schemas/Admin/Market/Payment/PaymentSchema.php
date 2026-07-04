<?php

namespace App\OpenApi\Schemas\Admin\Market\Payment;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Payment",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "amount",
            type: "string",
            example: "20000.000"
        ),
        new OA\Property(
            property: "status",
            type: "string",
            example: "not_paid",
            enum: ["not_paid", "paid", "canceled", "returned"]
        ),
        new OA\Property(
            property: "type",
            type: "string",
            example: "online",
            enum: ["online", "cash"]
        ),
        new OA\Property(
            property: "user",
            ref: "#/components/schemas/Customer"
        ),
        new OA\Property(
            property: "payment_details",
            oneOf: [
                new OA\Schema(
                    ref: "#/components/schemas/CashPayment"
                ),
                new OA\Schema(
                    ref: "#/components/schemas/OnlinePayment"
                ),
            ]
        ),
    ],
    type: "object"
)]
class PaymentSchema
{

}
