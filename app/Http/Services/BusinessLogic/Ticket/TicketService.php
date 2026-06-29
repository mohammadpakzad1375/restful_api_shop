<?php

namespace App\Http\Services\BusinessLogic\Ticket;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Ticket\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketService
{
    public function showAllTickets(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Ticket::orderBy('created_at','desc')->paginate(10);

        });
    }

    public function showNewTickets(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            $tickets = Ticket::unseen()->orderBy('created_at','desc')->paginate(10);

            Ticket::whereIn('id', $tickets->pluck('id'))->update(['seen' => 1]);

            return $tickets;

        });
    }

    public function showOpenTickets(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Ticket::open()->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function showCloseTickets(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Ticket::close()->orderBy('created_at','desc')->paginate(10);

        });
    }

    public function showTicket(Ticket $ticket): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($ticket){

            return  $ticket->load([
                'ticketCategory',
                'ticketPriority',
                'user',
                'ticketAdmin.user',
                'parent',
                'answers',
            ]);

        });
    }

    public function answerTicket($inputs, Ticket $ticket): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $ticket){

            $inputs['subject'] = $ticket->subject;
            $inputs['seen'] = 1;
            $inputs['reference_id'] = $ticket->reference_id;
            $inputs['user_id'] = $ticket->user_id;
            $inputs['category_id'] = $ticket->category_id;
            $inputs['priority_id'] = $ticket->priority_id;
            $inputs['ticket_id'] = $ticket->id;

            return Ticket::create($inputs);
        });
    }

    public function toggleTicketStatus(Ticket $ticket): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($ticket){

            $ticket->toggleStatus();
            return $ticket->refresh()->status;

        });
    }
}
