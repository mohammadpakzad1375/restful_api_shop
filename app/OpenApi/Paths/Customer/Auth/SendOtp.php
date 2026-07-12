<?php

namespace App\OpenApi\Paths\Customer\Auth;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/customer/auth/send-otp",
    description: "Send otp code for customer user.",
    summary: "Send Otp Code",
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['email'],
            properties:[
                new OA\Property(
                    property: "email",
                    type: "string",
                    format: "email",
                    example: "mohammad@example.com"
                )
            ]
        )
    ),
    tags: ["Customer/Auth"],
    responses: [
        new OA\Response(
            response: 200,
            description: "OTP sent successfully.",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "success",
                        type: "boolean",
                        example: true
                    ),
                    new OA\Property(
                        property: "message",
                        type: "string",
                        example: "OTP sent successfully."
                    )
                ]
            )
        ),
        new OA\Response(
            response: 422,
            description: "Validation Error",
            content: new OA\JsonContent(
                ref: "#/components/schemas/ValidationError"
            )
        )
    ]
)]
class SendOtp
{

}
