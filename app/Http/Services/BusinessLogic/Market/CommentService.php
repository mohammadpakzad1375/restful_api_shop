<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Content\Comment;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function showAllComments(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            $comments = Comment::where('commentable_type', Product::class)->orderBy('created_at','desc')->paginate(10);

            Comment::where('commentable_type', Product::class)->where('seen', 0)->update(['seen' => 1]);

            return $comments ;

        });
    }

    public function createComment($inputs, Product $product): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $product){

            $inputs['author_id'] = Auth::guard('customer')->id();
            $inputs['commentable_id'] = $product->id;
            $inputs['commentable_type'] = Product::class;

            return Comment::create($inputs);
        });
    }

    public function showComment(Comment $comment): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($comment){

            return  $comment->load(['author','commentable','parent','answers']);

        });
    }

    public function deleteComment(Comment $comment): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($comment){

            $comment->delete();

        });
    }

    public function toggleCommentApproved(Comment $comment): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($comment){

            $comment->toggleApproved();
            return $comment->refresh()->approved;

        });
    }
}
