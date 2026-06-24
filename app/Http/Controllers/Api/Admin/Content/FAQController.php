<?php

namespace App\Http\Controllers\Api\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Content\Faq\FaqStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Content\Faq\FaqUpdateApiRequest;
use App\Http\Services\BusinessLogic\Content\FaqService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Content\Faq;
use OpenApi\Attributes as OA;

class FAQController extends Controller
{
    public function __construct(private FaqService $faqService)
    {
    }

    #[OA\Get(
        path: '/api/admin/content/faq',
        description: 'Retrieve list of FAQs.',
        summary: 'List FAQs',
        security: [['sanctumAuth' => []]],
        tags: ['Admin/Content/FAQ'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'FAQs retrieved successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'success',
                            type: 'boolean',
                            example: true
                        ),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                ref: "#/components/schemas/FAQ"
                            )
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: "Unauthenticated",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/UnauthenticatedError"
                )
            ),
            new OA\Response(
                response: 403,
                description: "Forbidden",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ForbiddenError"
                )
            ),
        ]
    )]
    public function index()
    {
        $result = $this->faqService->showAllFaqs();

        return ApiResponse::withData($result->data)
            ->build()
            ->response($result->success);
    }

    #[OA\Post(
        path: "/api/admin/content/faq",
        summary: "Create FAQ",
        security: [["sanctumAuth" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: [
                    "question",
                    "answer",
                    "tags"
                ],
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
                        description: "FAQ status (optional)",
                        type: "integer",
                        example: 1,
                        enum: [0, 1]
                    )
                ]
            )
        ),
        tags: ["Admin/Content/FAQ"],
        responses: [
            new OA\Response(
                response: 201,
                description: "FAQ created successfully",
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
                            example: "FAQ created successfully."
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/FAQ"
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: "Unauthenticated",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/UnauthenticatedError"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Validation Error",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ValidationError"
                )
            ),
            new OA\Response(
                response: 403,
                description: "Forbidden",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ForbiddenError"
                )
            ),
        ]
    )]
    public function store(FaqStoreApiRequest $request)
    {
        $result = $this->faqService->createFaq($request->validated());

        return ApiResponse::withResponseMessage('FAQ created successfully.')
            ->withResponseStatus(201)
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    #[OA\Get(
        path: "/api/admin/content/faq/{id}",
        description: "Show a FAQ by its ID.",
        summary: "Show FAQ details",
        security: [["sanctumAuth" => []]],
        tags: ["Admin/Content/FAQ"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "FAQ ID",
                in: "path",
                required: true,
                schema: new OA\Schema(
                    type: "integer",
                    example: 1
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "FAQ details retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "success",
                            type: "boolean",
                            example: true
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/FAQ"
                        )
                    ],
                    type: "object"
                )
            ),
            new OA\Response(
                response: 401,
                description: "Unauthenticated",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/UnauthenticatedError"
                )
            ),
            new OA\Response(
                response: 403,
                description: "Forbidden",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ForbiddenError"
                )
            ),
            new OA\Response(
                response: 404,
                description: "FAQ not found",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ModelNotFoundError"
                )
            )
        ]
    )]
    public function show(Faq $faq)
    {
        return ApiResponse::withData($faq)
            ->build()
            ->response((bool) $faq);
    }

    #[OA\Patch(
        path: "/api/admin/content/faq/{id}",
        description: "Update a FAQ by its ID.",
        summary: "Update a FAQ",
        security: [["sanctumAuth" => []]],
        requestBody: new OA\RequestBody(
            required: false,
            content: new OA\JsonContent(
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
            )
        ),
        tags: ["Admin/Content/FAQ"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "FAQ ID",
                in: "path",
                required: true,
                schema: new OA\Schema(
                    type: "integer",
                    example: 1
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "FAQ updated successfully",
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
                            example: "FAQ updated successfully."
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/FAQ"
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: "Unauthenticated",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/UnauthenticatedError"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Validation Error",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ValidationError"
                )
            ),
            new OA\Response(
                response: 404,
                description: "FAQ not found",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ModelNotFoundError"
                )
            ),
            new OA\Response(
                response: 403,
                description: "Forbidden",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ForbiddenError"
                )
            ),
        ]
    )]
    public function update(FaqUpdateApiRequest $request, Faq $faq)
    {
        $result = $this->faqService->updateFaq($request->validated(), $faq);

        return ApiResponse::withResponseMessage('FAQ updated successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    #[OA\Delete(
        path: "/api/admin/content/faq/{id}",
        description: "Delete a FAQ by its ID.",
        summary: "Delete a FAQ",
        security: [["sanctumAuth" => []]],
        tags: ["Admin/Content/FAQ"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "FAQ ID",
                in: "path",
                required: true,
                schema: new OA\Schema(
                    type: "integer",
                    example: 1
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "FAQ deleted successfully",
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
                            example: "FAQ deleted successfully."
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: "Unauthenticated",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/UnauthenticatedError"
                )
            ),
            new OA\Response(
                response: 422,
                description: "Validation Error",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ValidationError"
                )
            ),
            new OA\Response(
                response: 404,
                description: "FAQ not found",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ModelNotFoundError"
                )
            ),
            new OA\Response(
                response: 403,
                description: "Forbidden",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ForbiddenError"
                )
            ),
        ]
    )]
    public function destroy(Faq $faq)
    {
        $result = $this->faqService->deleteFaq($faq);

        return ApiResponse::withResponseMessage('FAQ deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
