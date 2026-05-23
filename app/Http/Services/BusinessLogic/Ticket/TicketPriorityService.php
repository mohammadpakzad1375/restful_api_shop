<?php

namespace App\Http\Services\BusinessLogic\Ticket;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Content\Faq;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketPriority;

class TicketPriorityService
{
    public function showAllTicketPriorities(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return TicketPriority::orderBy('created_at','desc')->get();

        });
    }

    public function createTicketPriority($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            return TicketPriority::create($inputs);
        });
    }

    public function updateTicketPriority($inputs, TicketPriority $priority): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $priority){

            $priority->update($inputs);
            return $priority->refresh();

        });
    }

    public function deleteTicketPriority(TicketPriority $priority): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($priority){

            $priority->delete();

        });
    }
}
