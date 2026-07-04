<?php

namespace App\OpenApi\Requests\Admin\Market\Storage;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "StorageUpdateRequest",
    properties: [
        new OA\Property(
            property: "marketable_number",
            type: "integer",
            example: 30
        ),
        new OA\Property(
            property: "sold_number",
            type: "integer",
            example: 4
        ),
        new OA\Property(
            property: "frozen_number",
            type: "integer",
            example: 6
        )
    ]
)]
class StorageUpdateRequest
{

}
