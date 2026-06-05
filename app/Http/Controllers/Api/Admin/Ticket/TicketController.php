<?php

namespace App\Http\Controllers\Api\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Ticket\Ticket\TicketStoreApiRequest;
use App\Http\Resources\Ticke\Ticket\TicketApiResource;
use App\Http\Resources\Ticke\Ticket\TicketApiResourceCollection;
use App\Http\Services\BusinessLogic\Ticket\TicketService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(private TicketService $ticketService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->ticketService->showAllTickets();

        return ApiResponse::withData(TicketApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function newTickets()
    {
        $result = $this->ticketService->showNewTickets();

        return ApiResponse::withData(TicketApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function openTickets()
    {
        $result = $this->ticketService->showOpenTickets();

        return ApiResponse::withData(TicketApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function closeTickets()
    {
        $result = $this->ticketService->showCloseTickets();

        return ApiResponse::withData(TicketApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $result = $this->ticketService->showTicket($ticket);

        return ApiResponse::withData(TicketApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function answer(TicketStoreApiRequest $request, Ticket $ticket)
    {
        $result = $this->ticketService->answerTicket($request->validated(), $ticket);

        return ApiResponse::withResponseMessage('Ticket created successfully.')
            ->withData(TicketApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function changeStatus(Ticket $ticket)
    {
        $result = $this->ticketService->toggleTicketStatus($ticket);

        return ApiResponse::withResponseMessage("Ticket status change successfully. status = {$result->data}")
            ->build()
            ->response($result->success);
    }
}
