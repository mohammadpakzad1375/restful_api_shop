<?php

namespace App\OpenApi\Requests\Admin\Market\Delivery;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "DeliveryUpdateRequest",
    properties: [
        new OA\Property(
            property: "name",
            type: "string",
            example: "ارسال اکسپرس"
        ),
        new OA\Property(
            property: "amount",
            type: "number",
            example: 100000
        ),

        new OA\Property(
            property: "delivery_time",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "delivery_time_unit",
            type: "string",
            example: "روز"
        )
    ]
)]
class DeliveryUpdateRequest
{

}
