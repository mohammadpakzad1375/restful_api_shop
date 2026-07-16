<?php

namespace App\OpenApi\Schemas\Content\Faq;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "FAQ",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1),
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
        )
    ],
    type: "object"
)]
class FaqSchema
{

}
