<?php

namespace App\OpenApi\Requests\Admin\Content\Menu;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "MenuStoreRequest",
    required: [
        "name",
        "parent_id",
        "url"
    ],
    properties: [
        new OA\Property(
            property: "name",
            type: "string",
            example: "درباره ما"
        ),
        new OA\Property(
            property: "parent_id",
            type: "integer",
            example: 1,
            nullable: true
        ),
        new OA\Property(
            property: "url",
            type: "string",
            example: "https://example.com/about"
        ),
        new OA\Property(
            property: "status",
            description: "Menu status (optional)",
            type: "integer",
            example: 1,
            enum: [0, 1]
        )
    ]
)]
class MenuStoreRequest
{

}
