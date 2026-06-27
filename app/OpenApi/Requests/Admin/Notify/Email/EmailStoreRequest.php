<?php

namespace App\OpenApi\Requests\Admin\Notify\Email;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "EmailStoreRequest",
    required: [
        "subject",
        "body",
        "published_at"
    ],
    properties: [
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
            description: "Unix timestamp",
            type: "integer",
            example: 1782331200
        ),
        new OA\Property(
            property: "status",
            description: "Email status (optional)",
            type: "integer",
            example: 1,
            enum: [0, 1]
        )
    ]
)]
class EmailStoreRequest
{

}
