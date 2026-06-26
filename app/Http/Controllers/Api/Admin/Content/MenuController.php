<?php

namespace App\Http\Controllers\Api\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Content\Menu\MenuStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Content\Menu\MenuUpdateApiRequest;
use App\Http\Resources\Content\Menu\MenuApiResource;
use App\Http\Resources\Content\Menu\MenuApiResourceCollection;
use App\Http\Services\BusinessLogic\Content\MenuService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Content\Menu;
use OpenApi\Attributes as OA;

class MenuController extends Controller
{
    public function __construct(private MenuService $menuService)
    {
    }

    #[OA\Get(
        path: '/api/admin/content/menu',
        description: 'Retrieve a paginated list of menus.',
        summary: 'List menus',
        security: [['sanctumAuth' => []]],
        tags: ['Admin/Content/Menu'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Menus retrieved successfully',
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
                                properties: [
                                    new OA\Property(
                                        property: "id",
                                        type: "integer",
                                        example: 1),
                                    new OA\Property(
                                        property: "name",
                                        type: "string",
                                        example: "درباره ما"
                                    ),
                                    new OA\Property(
                                        property: "url",
                                        type: "string",
                                        example: "https://example.com/about"
                                    ),
                                    new OA\Property(
                                        property: "parent",
                                        type: "integer",
                                        example: 1,
                                        nullable: true
                                    )
                                ],
                                type: "object"
                            )
                        ),
                        new OA\Property(
                            property: "meta",
                            ref: "#/components/schemas/PaginationMeta"
                        ),
                        new OA\Property(
                            property: "links",
                            ref: "#/components/schemas/PaginationLinks"
                        ),
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
    #[OA\Parameter(
        name: 'page',
        description: 'Page number',
        in: 'query',
        required: false,
        schema: new OA\Schema(
            type: 'integer',
            default: 1
        )
    )]
    public function index()
    {
        $result = $this->menuService->showAllMenus();

        return ApiResponse::withData(MenuApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    #[OA\Post(
        path: "/api/admin/content/menu",
        summary: "Create menu",
        security: [["sanctumAuth" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: [
                    "name",
                    "parent_id",
                    "url"
                ],
                properties: [
                    new OA\Property(
                        property: "name",
                        type: "string",
                        example: "درباره ما"
                    ),
                    new OA\Property(
                        property: "parent_id",
                        type: "integer",
                        example: 1,
                        nullable: true
                    ),
                    new OA\Property(
                        property: "url",
                        type: "string",
                        example: "https://example.com/about"
                    ),
                    new OA\Property(
                        property: "status",
                        description: "Menu status (optional)",
                        type: "integer",
                        example: 1,
                        enum: [0, 1]
                    )
                ]
            )
        ),
        tags: ["Admin/Content/Menu"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Menu created successfully",
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
                            example: "Menu created successfully."
                        ),
                        new OA\Property(
                            property: "data",
                            properties: [
                                new OA\Property(
                                    property: "id",
                                    type: "integer",
                                    example: 1),
                                new OA\Property(
                                    property: "name",
                                    type: "string",
                                    example: "درباره ما"
                                ),
                                new OA\Property(
                                    property: "url",
                                    type: "string",
                                    example: "https://example.com/about"
                                ),
                                new OA\Property(
                                    property: "parent",
                                    type: "integer",
                                    example: 1,
                                    nullable: true
                                )
                            ],
                            type: "object"
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
    public function store(MenuStoreApiRequest $request)
    {
        $result = $this->menuService->createMenu($request->validated());

        return ApiResponse::withResponseMessage('Menu created successfully.')
            ->withResponseStatus(201)
            ->withData(MenuApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    #[OA\Get(
        path: "/api/admin/content/menu/{id}",
        description: "Show a menu by its ID.",
        summary: "Show menu details",
        security: [["sanctumAuth" => []]],
        tags: ["Admin/Content/Menu"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Menu ID",
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
                description: "Menu details retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "success",
                            type: "boolean",
                            example: true
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/MenuTree"
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
                description: "Menu not found",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ModelNotFoundError"
                )
            )
        ]
    )]
    public function show(Menu $menu)
    {
        $result = $this->menuService->showMenu($menu);

        return ApiResponse::withData(MenuApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    #[OA\Patch(
        path: "/api/admin/content/menu/{id}",
        description: "Update a menu by its ID.",
        summary: "Update a menu",
        security: [["sanctumAuth" => []]],
        requestBody: new OA\RequestBody(
            required: false,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "name",
                        type: "string",
                        example: "درباره ما"
                    ),
                    new OA\Property(
                        property: "parent_id",
                        type: "integer",
                        example: 1,
                        nullable: true
                    ),
                    new OA\Property(
                        property: "url",
                        type: "string",
                        example: "https://example.com/about"
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
        tags: ["Admin/Content/Menu"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Menu ID",
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
                description: "Menu updated successfully",
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
                            example: "Menu updated successfully."
                        ),
                        new OA\Property(
                            property: "data",
                            properties: [
                                new OA\Property(
                                    property: "id",
                                    type: "integer",
                                    example: 1),
                                new OA\Property(
                                    property: "name",
                                    type: "string",
                                    example: "درباره ما"
                                ),
                                new OA\Property(
                                    property: "url",
                                    type: "string",
                                    example: "https://example.com/about"
                                ),
                                new OA\Property(
                                    property: "parent",
                                    type: "integer",
                                    example: 1,
                                    nullable: true
                                )
                            ],
                            type: "object"
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
                description: "Menu not found",
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
    public function update(MenuUpdateApiRequest $request, Menu $menu)
    {
        $result = $this->menuService->updateMenu($request->validated(), $menu);

        return ApiResponse::withResponseMessage('Menu updated successfully.')
            ->withData(MenuApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    #[OA\Delete(
        path: "/api/admin/content/menu/{id}",
        description: "Delete a menu by its ID.",
        summary: "Delete a menu",
        security: [["sanctumAuth" => []]],
        tags: ["Admin/Content/Menu"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Menu ID",
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
                description: "Menu deleted successfully",
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
                            example: "Menu deleted successfully."
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
                description: "Menu not found",
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
    public function destroy(Menu $menu)
    {
        $result = $this->menuService->deleteMenu($menu);

        return ApiResponse::withResponseMessage('Menu deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
