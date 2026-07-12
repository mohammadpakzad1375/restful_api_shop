<?php

namespace App\OpenApi\Paths\Customer\Auth;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/customer/auth/refresh",
    description: "Rotate refresh token and retrieve new refresh token and new access token.",
    summary: "Rotate Refresh Token",
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: [
                'refresh_token'
                ],
            properties:[
                new OA\Property(
                    property: "refresh_token",
                    type: "string",
                    example: "77a559be00fe3a4a40afd2de555071e5c0c5ba03f869e43932f43388b566dddb",
                    maxLength: 64,
                    minLength: 64
                )
            ]
        )
    ),
    tags: ["Customer/Auth"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Token refreshed successfully.",
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
                        example: "Token refreshed successfully."
                    ),
                    new OA\Property(
                        property: "data",
                        properties: [
                            new OA\Property(
                                property: "access_token",
                                type: "string",
                                example: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2N1c3RvbWVyL2F1dGgvdmVyaWZ5LW90cCIsImlhdCI6MTc4Mzg1NjI4NiwiZXhwIjoxNzgzODU3MTg2LCJuYmYiOjE3ODM4NTYyODYsImp0aSI6Ik1neFFQN3hBdWpUM0QzUm0iLCJzdWIiOiIyIiwicHJ2IjoiYjkxMjc5OTc4ZjExYWE3YmM1NjcwNDg3ZmZmMDFlMjI4MjUzZmU0OCJ9.x8-Nl9bjZbDmBZmpoX8WGmBK1wlPYVUByQrlYNL6tPc"
                            ),
                            new OA\Property(
                                property: "refresh_token",
                                type: "string",
                                example: "77a559be00fe3a4a40afd2de555071e5c0c5ba03f869e43932f43388b566dddb",
                                maxLength: 64,
                                minLength: 64
                            ),
                            new OA\Property(
                                property: "token_type",
                                type: "string",
                                const: "Bearer"
                            ),
                            new OA\Property(
                                property: "expires_in",
                                type: "integer",
                                const: 900
                            )
                        ],
                        type: "object"
                    )
                ]
            )
        ),
        new OA\Response(
          response: 401,
          description: "Invalid credentials",
          content: new OA\JsonContent(
              oneOf: [
                    new OA\Schema(
                        properties: [
                            new OA\Property(
                                property: "success",
                                type: "boolean",
                                example: false
                            ),
                            new OA\Property(
                                property: "message",
                                type: "string",
                                const: "Invalid refresh token."
                            ),
                        ],
                        type: "object"
                    ),
                    new OA\Schema(
                        properties: [
                            new OA\Property(
                                property: "success",
                                type: "boolean",
                                example: false
                            ),
                            new OA\Property(
                                property: "message",
                                type: "string",
                                const: "Refresh token expired."
                            ),
                        ],
                        type: "object"
                    ),
                    new OA\Schema(
                        properties: [
                            new OA\Property(
                                property: "success",
                                type: "boolean",
                                example: false
                            ),
                            new OA\Property(
                                property: "message",
                                type: "string",
                                const: "Refresh token revoked."
                            ),
                        ],
                        type: "object"
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
class Refresh
{

}
