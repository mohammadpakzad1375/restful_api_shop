<?php

namespace App\Http\Controllers\Api\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Content\Page\PageStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Content\Page\PageUpdateApiRequest;
use App\Http\Services\BusinessLogic\Content\PageService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Content\Page;
use OpenApi\Attributes as OA;

class PageController extends Controller
{
    public function __construct(private PageService $pageService)
    {
    }

    #[OA\Get(
        path: '/api/admin/content/page',
        description: 'Retrieve list of pages.',
        summary: 'List pages',
        security: [['sanctumAuth' => []]],
        tags: ['Admin/Content/Page'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Pages retrieved successfully',
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
                                ref: "#/components/schemas/Page"
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
        $result = $this->pageService->showAllPages();

        return ApiResponse::withData($result->data)
            ->build()
            ->response($result->success);
    }

    #[OA\Post(
        path: "/api/admin/content/page",
        summary: "Create page",
        security: [["sanctumAuth" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: [
                    "title",
                    "body",
                    "tags"
                ],
                properties: [
                    new OA\Property(
                        property: "title",
                        type: "string",
                        example: "راهنمای جامع هوش مصنوعی در توسعه نرم‌افزار"
                    ),
                    new OA\Property(
                        property: "body",
                        type: "string",
                        example: "در این صفحه به بررسی کاربردهای هوش مصنوعی در توسعه نرم‌افزار، مزایا، چالش‌ها و ابزارهای پرکاربرد پرداخته شده است. همچنین نمونه‌هایی از استفاده عملی آن در پروژه‌های واقعی ارائه می‌شود."
                    ),
                    new OA\Property(
                        property: "tags",
                        type: "string",
                        example: "هوش مصنوعی-برنامه نویسی-لاراول-توسعه نرم افزار"
                    ),
                    new OA\Property(
                        property: "status",
                        description: "Page status (optional)",
                        type: "integer",
                        example: 1,
                        enum: [0, 1]
                    )
                ]
            )
        ),
        tags: ["Admin/Content/Page"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Page created successfully",
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
                            example: "Page created successfully."
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/Page"
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
    public function store(PageStoreApiRequest $request)
    {
        $result = $this->pageService->createPage($request->validated());

        return ApiResponse::withResponseMessage('Page created successfully.')
            ->withResponseStatus(201)
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    #[OA\Get(
        path: "/api/admin/content/page/{id}",
        description: "Show a page by its ID.",
        summary: "Show page details",
        security: [["sanctumAuth" => []]],
        tags: ["Admin/Content/Page"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Page ID",
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
                description: "Page details retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "success",
                            type: "boolean",
                            example: true
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/Page"
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
                description: "Page not found",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ModelNotFoundError"
                )
            )
        ]
    )]
    public function show(Page $page)
    {
        return ApiResponse::withData($page)
            ->build()
            ->response((bool) $page);
    }

    #[OA\Patch(
        path: "/api/admin/content/page/{id}",
        description: "Update a page by its ID.",
        summary: "Update a page",
        security: [["sanctumAuth" => []]],
        requestBody: new OA\RequestBody(
            required: false,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "title",
                        type: "string",
                        example: "راهنمای جامع هوش مصنوعی در توسعه نرم‌افزار"
                    ),
                    new OA\Property(
                        property: "body",
                        type: "string",
                        example: "در این صفحه به بررسی کاربردهای هوش مصنوعی در توسعه نرم‌افزار، مزایا، چالش‌ها و ابزارهای پرکاربرد پرداخته شده است. همچنین نمونه‌هایی از استفاده عملی آن در پروژه‌های واقعی ارائه می‌شود."
                    ),
                    new OA\Property(
                        property: "tags",
                        type: "string",
                        example: "هوش مصنوعی-برنامه نویسی-لاراول-توسعه نرم افزار"
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
        tags: ["Admin/Content/Page"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Page ID",
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
                description: "Page updated successfully",
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
                            example: "Page updated successfully."
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/Page"
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
                description: "Page not found",
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
    public function update(PageUpdateApiRequest $request, Page $page)
    {
        $result = $this->pageService->updatePage($request->validated(), $page);

        return ApiResponse::withResponseMessage('Page updated successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    #[OA\Delete(
        path: "/api/admin/content/page/{id}",
        description: "Delete a page by its ID.",
        summary: "Delete a page",
        security: [["sanctumAuth" => []]],
        tags: ["Admin/Content/Page"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Page ID",
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
                description: "Page deleted successfully",
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
                            example: "Page deleted successfully."
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
                description: "Page not found",
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
    public function destroy(Page $page)
    {
        $result = $this->pageService->deletePage($page);

        return ApiResponse::withResponseMessage('Page deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
