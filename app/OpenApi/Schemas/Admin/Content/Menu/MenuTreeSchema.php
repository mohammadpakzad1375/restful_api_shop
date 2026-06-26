<?php

namespace App\OpenApi\Schemas\Admin\Content\Menu;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "MenuTree",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "name",
            type: "string",
            example: "درباره ما"
        ),
        new OA\Property(
            property: "url",
            type: "string",
            format: "uri",
            example: "https://example.com/about"
        ),
        new OA\Property(
            property: "parent",
            example: null,
            nullable: true
        ),
        new OA\Property(
            property: "children",
            type: "array",
            items: new OA\Items(
                type: "object"
            ),
            example: []
        ),
    ],
    type: "object"
)]
class MenuTreeSchema
{

}
