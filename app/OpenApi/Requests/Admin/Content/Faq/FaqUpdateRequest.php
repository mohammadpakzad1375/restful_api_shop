<?php

namespace App\OpenApi\Requests\Admin\Content\Faq;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "FaqUpdateRequest",
    properties: [
        new OA\Property(
            property: "question",
            type: "string",
            example: "چگونه رمز عبور حساب کاربری خود را تغییر دهم؟"
        ),
        new OA\Property(
            property: "answer",
            type: "string",
            example: "پس از ورود به حساب کاربری، از بخش تنظیمات پروفایل وارد قسمت امنیت شوید."
        ),
        new OA\Property(
            property: "tags",
            type: "string",
            example: "حساب کاربری-رمز عبور-امنیت"
        ),
        new OA\Property(
            property: "status",
            type: "integer",
            example: 1,
            enum: [0, 1]
        )
    ]
)]
class FaqUpdateRequest
{

}
