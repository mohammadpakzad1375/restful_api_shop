<?php

namespace App\Http\Controllers\Api\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Resources\Content\Comment\CommentApiResource;
use App\Http\Resources\Content\Comment\CommentApiResourceCollection;
use App\Http\Services\BusinessLogic\Content\CommentService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Content\Comment;

class CommentController extends Controller
{
    public function __construct(private CommentService $commentService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->commentService->showAllComments();

        return ApiResponse::withData(CommentApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $result = $this->commentService->showComment($comment);

        return ApiResponse::withData(CommentApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $result = $this->commentService->deleteComment($comment);

        return ApiResponse::withResponseMessage('Comment deleted successfully.')
            ->build()
            ->response($result->success);
    }

    public function approved(Comment $comment)
    {
        $result = $this->commentService->toggleCommentApproved($comment);

        return ApiResponse::withResponseMessage("Comment approved change successfully. approved = {$result->data}")
            ->build()
            ->response($result->success);
    }

    public function status(Comment $comment)
    {
        $result = $this->commentService->toggleCommentStatus($comment);

        return ApiResponse::withResponseMessage("Comment status change successfully. status = {$result->data}")
            ->build()
            ->response($result->success);
    }
}
