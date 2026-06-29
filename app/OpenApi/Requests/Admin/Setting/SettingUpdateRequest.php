<?php

namespace App\OpenApi\Requests\Admin\Setting;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "SettingUpdateRequest",
    properties: [
        new OA\Property(
            property: "title",
            type: "string",
            example: "TechZone",
        ),
        new OA\Property(
            property: "description",
            type: "string",
            example: "فروشگاه اینترنتی TechZone ارائه‌دهنده انواع کالاهای دیجیتال، لوازم خانگی",
        ),
        new OA\Property(
            property: "keywords",
            type: "string",
            example: "فروشگاه اینترنتی-خرید آنلاین-کالای دیجیتال-لوازم خانگی-موبایل",
        ),
        new OA\Property(
            property: "logo",
            description: "Logo image",
            type: "string",
            format: "binary"
        ),
        new OA\Property(
            property: "icon",
            description: "Icon image",
            type: "string",
            format: "binary"
        ),
    ]
)]
class SettingUpdateRequest
{

}
