<?php

namespace App\OpenApi\Schemas\Admin\Setting;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Setting",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1),
        new OA\Property(
            property: "title",
            type: "string",
            example: "TechZone"
        ),
        new OA\Property(
            property: "description",
            type: "string",
            example: "فروشگاه اینترنتی TechZone ارائه‌دهنده انواع کالاهای دیجیتال، لوازم خانگی، پوشاک و محصولات متنوع با تضمین کیفیت، ارسال سریع و پشتیبانی ۲۴ ساعته."
        ),
        new OA\Property(
            property: "keywords",
            type: "string",
            example: "فروشگاه اینترنتی-خرید آنلاین-کالای دیجیتال-لوازم خانگی-موبایل"
        ),
        new OA\Property(
            property: "logo",
            type: "string",
            example: "images\\setting\\2026\\06\\29\\1782742249_dcd81b65.png"
        ),
        new OA\Property(
            property: "icon",
            type: "string",
            example: "images\\setting\\2026\\06\\29\\1782742249_6e590416.png"
        )
    ],
    type: "object"
)]
class SettingSchema
{

}
