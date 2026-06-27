<?php

namespace App\OpenApi\Schemas\Admin\Notify\Email;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Email",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1),
        new OA\Property(
            property: "subject",
            type: "string",
            example: "اطلاعیه بروزرسانی سامانه"
        ),
        new OA\Property(
            property: "body",
            type: "string",
            example: "نسخه جدید سامانه با بهبود عملکرد، رفع برخی خطاها و افزایش امنیت منتشر شده است. لطفاً برای استفاده از قابلیت‌های جدید، آخرین نسخه را بررسی کنید."
        ),
        new OA\Property(
            property: "published_at",
            type: "string",
            example: "2026-06-24 23:00:00"
        ),
    ],
    type: "object"
)]
class EmailSchema
{

}
