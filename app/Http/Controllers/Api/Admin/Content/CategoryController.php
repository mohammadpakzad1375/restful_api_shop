<?php

namespace App\Http\Controllers\Api\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Content\PostCategory\PostCategoryStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Content\PostCategory\PostCategoryUpdateApiRequest;
use App\Http\Resources\Content\PostCategory\PostCategoryApiResource;
use App\Http\Resources\Content\PostCategory\PostCategoryApiResourceCollection;
use App\Http\Services\BusinessLogic\Content\PostCategoryService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Content\PostCategory;
use OpenApi\Attributes as OA;

class CategoryController extends Controller
{
    public function __construct(private PostCategoryService $postCategoryService)
    {
    }

    #[OA\Get(
        path: '/api/admin/content/category',
        description: 'Retrieve a paginated list of post categories.',
        summary: 'List Post Categories',
        security: [['sanctumAuth' => []]],
        tags: ['Admin/Content/Post Category'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Post categories retrieved successfully',
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
                                ref: "#/components/schemas/PostCategory"
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
        $result = $this->postCategoryService->showAllPostCategories();

        return ApiResponse::withData(PostCategoryApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    #[OA\Post(
        path: "/api/admin/content/category",
        summary: "Create Post Category",
        security: [['sanctumAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: "multipart/form-data",
                schema: new OA\Schema(
                    required: ["name","description","image","tags"],
                    properties: [
                        new OA\Property(
                            property: "name",
                            type: "string",
                            example: "ورزشی"
                        ),
                        new OA\Property(
                            property: "description",
                            type: "string",
                            example: "بررسی جدید ترین خبرهای ورزشی"
                        ),
                        new OA\Property(
                            property: "image",
                            description: "Category image",
                            type: "string",
                            format: "binary"
                        ),
                        new OA\Property(
                            property: "tags",
                            type: "string",
                            example: "ورزشی"
                        ),
                        new OA\Property(
                            property: "status",
                            description: "Post category status (optional)",
                            type: "integer",
                            example: 1,
                            enum: [0, 1],
                        ),
                    ]
                )
            )
        ),
        tags: ["Admin/Content/Post Category"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Post category created successfully",
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
                            example: "PostCategory created successfully."
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/PostCategory"
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
    public function store(PostCategoryStoreApiRequest $request)
    {
        $result = $this->postCategoryService->createPostCategory($request->validated());

        return ApiResponse::withResponseMessage('postCategory created successfully.')
            ->withResponseStatus(201)
            ->withData(PostCategoryApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    #[OA\Get(
        path: "/api/admin/content/category/{id}",
        description: "Show a post category by its ID.",
        summary: "Show post category details",
        security: [["sanctumAuth" => []]],
        tags: ["Admin/Content/Post Category"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Post category ID",
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
                description: "Post category details retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "success",
                            type: "boolean",
                            example: true
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/PostCategory"
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
                description: "Post category not found",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ModelNotFoundError"
                )
            )
        ]
    )]
    public function show(PostCategory $category)
    {
        return ApiResponse::withData(PostCategoryApiResource::make($category))
            ->build()
            ->response((bool) $category);
    }

    #[OA\Patch(
        path: "/api/admin/content/category/{id}",
        description: "Update a post category by its ID.",
        summary: "Update a post category",
        security: [["sanctumAuth" => []]],
        requestBody: new OA\RequestBody(
            required: false,
            content: new OA\MediaType(
                mediaType: "multipart/form-data",
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(
                            property: "name",
                            type: "string",
                            example: "ورزشی"
                        ),
                        new OA\Property(
                            property: "description",
                            type: "string",
                            example: "بررسی جدید ترین خبرهای ورزشی"
                        ),
                        new OA\Property(
                            property: "image",
                            description: "Category image",
                            type: "string",
                            format: "binary"
                        ),
                        new OA\Property(
                            property: "tags",
                            type: "string",
                            example: "ورزشی"
                        ),
                        new OA\Property(
                            property: "status",
                            description: "Post category status (optional)",
                            type: "integer",
                            example: 1,
                            enum: [0, 1],
                        ),
                    ]
                )
            )
        ),
        tags: ["Admin/Content/Post Category"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Post category ID",
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
                description: "Post category updated successfully",
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
                            example: "PostCategory updated successfully."
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/PostCategory"
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
                description: "Post category not found",
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
    public function update(PostCategoryUpdateApiRequest $request, PostCategory $category)
    {
        $result = $this->postCategoryService->updatePostCategory($request->validated(), $category);

        return ApiResponse::withResponseMessage('postCategory updated successfully.')
            ->withData(PostCategoryApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    #[OA\Delete(
        path: "/api/admin/content/category/{id}",
        description: "Delete a post category by its ID.",
        summary: "Delete a post category",
        security: [["sanctumAuth" => []]],
        tags: ["Admin/Content/Post Category"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Post category ID",
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
                description: "Post category deleted successfully",
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
                            example: "PostCategory deleted successfully."
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
                description: "Post category not found",
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
    public function destroy(PostCategory $category)
    {
        $result = $this->postCategoryService->deletePostCategory($category);

        return ApiResponse::withResponseMessage('PostCategory deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
