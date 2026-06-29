<?php

namespace App\OpenApi\Schemas\Admin\Ticket\Ticket;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Ticket",
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1),
        new OA\Property(
            property: "subject",
            type: "string",
            example: "عدم امکان ورود به حساب کاربری"
        ),
        new OA\Property(
            property: "description",
            type: "string",
            example: "سلام، از صبح امروز هنگام ورود به حساب کاربری با پیام «نام کاربری یا رمز عبور اشتباه است» مواجه می‌شوم، در حالی که اطلاعات را به‌درستی وارد می‌کنم. همچنین امکان بازیابی رمز عبور نیز برای من کار نمی‌کند. لطفاً این مشکل را بررسی و در صورت امکان راهنمایی کنید."
        ),
        new OA\Property(
            property: "seen",
            type: "integer",
            example: 0
        ),
        new OA\Property(
            property: "status",
            type: "string",
            example: "open"
        ),
        new OA\Property(
            property: "ticket_admin_id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "user",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "category",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "priority",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "parent",
            type: "integer",
            example: null,
            nullable: true
        )
    ],
    type: "object"
)]
class TicketSchema
{

}
