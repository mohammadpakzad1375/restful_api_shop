<?php

namespace App\Http\Services\BusinessLogic\Content;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Content\Comment;
use App\Models\Content\Post;

class CommentService
{
    public function showAllComments(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Comment::where('commentable_type', Post::class)->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function showComment(Comment $comment): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($comment){

            return  $comment->load(['author','commentable','parent','answers']);

        });
    }
}
