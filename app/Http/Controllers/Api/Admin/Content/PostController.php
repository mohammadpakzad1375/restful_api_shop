<?php

namespace App\Http\Controllers\Api\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Content\Post\PostStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Content\Post\PostUpdateApiRequest;
use App\Http\Resources\Content\Post\PostApiResource;
use App\Http\Resources\Content\Post\PostApiResourceCollection;
use App\Http\Services\BusinessLogic\Content\PostService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Content\Post;
use OpenApi\Attributes as OA;

class PostController extends Controller
{
    public function __construct(private PostService $postService)
    {
    }

    #[OA\Get(
        path: '/api/admin/content/post',
        description: 'Retrieve a paginated list of posts.',
        summary: 'List Posts',
        security: [['sanctumAuth' => []]],
        tags: ['Admin/Content/Post'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Posts retrieved successfully',
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
                                ref: "#/components/schemas/Post"
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
        $result = $this->postService->showAllPosts();

        return ApiResponse::withData(PostApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    #[OA\Post(
        path: "/api/admin/content/post",
        summary: "Create Post",
        security: [["sanctumAuth" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: "multipart/form-data",
                schema: new OA\Schema(
                    required: [
                        "title",
                        "summary",
                        "body",
                        "category_id",
                        "image",
                        "commentable",
                        "published_at",
                        "tags"
                    ],
                    properties: [
                        new OA\Property(
                            property: "title",
                            type: "string",
                            example: "هوش مصنوعی چگونه آینده توسعه نرم‌افزار را متحول می‌کند؟",
                        ),
                        new OA\Property(
                            property: "summary",
                            type: "string",
                            example: "هوش مصنوعی در حال تغییر روش توسعه، تست و نگهداری نرم‌افزارها است.",
                        ),
                        new OA\Property(
                            property: "body",
                            type: "string",
                            example: "در سال‌های اخیر، هوش مصنوعی به یکی از مهم‌ترین فناوری‌های تأثیرگذار بر صنعت نرم‌افزار تبدیل شده است.",
                        ),
                        new OA\Property(
                            property: "category_id",
                            type: "integer",
                            example: 1
                        ),
                        new OA\Property(
                            property: "image",
                            description: "Post image",
                            type: "string",
                            format: "binary"
                        ),
                        new OA\Property(
                            property: "commentable",
                            type: "integer",
                            example: 1,
                            enum: [0, 1]
                        ),
                        new OA\Property(
                            property: "published_at",
                            description: "Unix timestamp",
                            type: "integer",
                            example: 1782331200
                        ),
                        new OA\Property(
                            property: "tags",
                            type: "string",
                            example: "هوش مصنوعی-فناوری-برنامه نویسی-AI-تکنولوژی"
                        ),
                        new OA\Property(
                            property: "status",
                            description: "Post status (optional)",
                            type: "integer",
                            example: 1,
                            enum: [0, 1]
                        ),
                    ]
                )
            )
        ),
        tags: ["Admin/Content/Post"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Post created successfully",
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
                            example: "Post created successfully."
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/Post"
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
    public function store(PostStoreApiRequest $request)
    {
        $result = $this->postService->createPost($request->validated());

        return ApiResponse::withResponseMessage('Post created successfully.')
            ->withResponseStatus(201)
            ->withData(PostApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    #[OA\Get(
        path: "/api/admin/content/post/{id}",
        description: "Show a post by its ID.",
        summary: "Show post details",
        security: [["sanctumAuth" => []]],
        tags: ["Admin/Content/Post"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Post ID",
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
                description: "Post details retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "success",
                            type: "boolean",
                            example: true
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/Post"
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
                description: "Post not found",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/ModelNotFoundError"
                )
            )
        ]
    )]
    public function show(Post $post)
    {
        $result = $this->postService->showPost($post);

        return ApiResponse::withData(PostApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    #[OA\Patch(
        path: "/api/admin/content/post/{id}",
        description: "Update a post by its ID.",
        summary: "Update a post",
        security: [["sanctumAuth" => []]],
        requestBody: new OA\RequestBody(
            required: false,
            content: new OA\MediaType(
                mediaType: "multipart/form-data",
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(
                            property: "title",
                            type: "string",
                            example: "هوش مصنوعی چگونه آینده توسعه نرم‌افزار را متحول می‌کند؟",
                        ),
                        new OA\Property(
                            property: "summary",
                            type: "string",
                            example: "هوش مصنوعی در حال تغییر روش توسعه، تست و نگهداری نرم‌افزارها است.",
                        ),
                        new OA\Property(
                            property: "body",
                            type: "string",
                            example: "در سال‌های اخیر، هوش مصنوعی به یکی از مهم‌ترین فناوری‌های تأثیرگذار بر صنعت نرم‌افزار تبدیل شده است.",
                        ),
                        new OA\Property(
                            property: "category_id",
                            type: "integer",
                            example: 1
                        ),
                        new OA\Property(
                            property: "image",
                            description: "Post image",
                            type: "string",
                            format: "binary"
                        ),
                        new OA\Property(
                            property: "commentable",
                            type: "integer",
                            example: 1,
                            enum: [0, 1]
                        ),
                        new OA\Property(
                            property: "published_at",
                            description: "Unix timestamp",
                            type: "integer",
                            example: 1782331200
                        ),
                        new OA\Property(
                            property: "tags",
                            type: "string",
                            example: "هوش مصنوعی-فناوری-برنامه نویسی-AI-تکنولوژی"
                        ),
                        new OA\Property(
                            property: "status",
                            type: "integer",
                            example: 1,
                            enum: [0, 1]
                        ),
                    ]
                )
            )
        ),
        tags: ["Admin/Content/Post"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Post ID",
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
                description: "Post updated successfully",
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
                            example: "Post updated successfully."
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/Post"
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
                description: "Post not found",
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
    public function update(PostUpdateApiRequest $request, Post $post)
    {
        $result = $this->postService->updatePost($request->validated(), $post);

        return ApiResponse::withResponseMessage('Post updated successfully.')
            ->withData(PostApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    #[OA\Delete(
        path: "/api/admin/content/post/{id}",
        description: "Delete a post by its ID.",
        summary: "Delete a post",
        security: [["sanctumAuth" => []]],
        tags: ["Admin/Content/Post"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Post ID",
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
                description: "Post deleted successfully",
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
                            example: "Post deleted successfully."
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
                description: "Post not found",
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
    public function destroy(Post $post)
    {
        $result = $this->postService->deletePost($post);

        return ApiResponse::withResponseMessage('Post deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
