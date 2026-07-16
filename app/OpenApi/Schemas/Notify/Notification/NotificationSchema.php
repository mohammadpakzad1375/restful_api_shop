<?php

namespace App\OpenApi\Schemas\Notify\Notification;


use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Notification",
    properties: [
        new OA\Property(
            property: "id",
            type: "string",
            format: "uuid",
            example: "37d9749d-d03a-4370-ac17-60da4e3022d0"
        ),
        new OA\Property(
            property: "type",
            type: "string",
            example: "admin-login"
        ),
        new OA\Property(
            property: "notifiable_type",
            type: "string",
            example: "App\\Models\\User\\User"
        ),
        new OA\Property(
            property: "notifiable_id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "data",
            type: "object",
            example: [
                "message" => "mohammad pakzad به سیستم خوش آمدید.",
                "data" => [
                    "admin_name" => "mohammad pakzad"
                ]
            ],
            additionalProperties: true
        ),
        new OA\Property(
            property: "read_at",
            type: "string",
            format: "date-time",
            example: "2026-06-27 15:28:55",
            nullable: true
        ),
        new OA\Property(
            property: "created_at",
            type: "string",
            format: "date-time",
            example: "2026-06-23 17:22:23"
        ),
    ]
)]
class NotificationSchema
{

}
