<?php

namespace App\Http\Services\BusinessLogic\Ticket;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Content\Faq;
use App\Models\Ticket\TicketCategory;

class TicketCategoryService
{
    public function showAllTicketCategories(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return TicketCategory::orderBy('created_at','desc')->get();

        });
    }

    public function createTicketCategory($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            return TicketCategory::create($inputs);
        });
    }

    public function updateTicketCategory($inputs, TicketCategory $category): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $category){

            $category->update($inputs);
            return $category->refresh();

        });
    }

    public function deleteTicketCategory(TicketCategory $category): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($category){

            $category->delete();

        });
    }
}
