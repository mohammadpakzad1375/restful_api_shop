<?php

namespace App\Http\Controllers\Api\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Ticket\TicketPriority\TicketPriorityStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Ticket\TicketPriority\TicketPriorityUpdateApiRequest;
use App\Http\Services\BusinessLogic\Ticket\TicketPriorityService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Ticket\TicketPriority;
use Illuminate\Http\Request;

class TicketPriorityController extends Controller
{
    public function __construct(private TicketPriorityService $ticketPriorityService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->ticketPriorityService->showAllTicketPriorities();

        return ApiResponse::withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketPriorityStoreApiRequest $request)
    {
        $result = $this->ticketPriorityService->createTicketPriority($request->validated());

        return ApiResponse::withResponseMessage('TicketPriority created successfully.')
            ->withResponseStatus(201)
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketPriority $priority)
    {
        return ApiResponse::withData($priority)
            ->build()
            ->response((bool) $priority);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketPriorityUpdateApiRequest $request, TicketPriority $priority)
    {
        $result = $this->ticketPriorityService->updateTicketPriority($request->validated(), $priority);

        return ApiResponse::withResponseMessage('TicketPriority updated successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketPriority $priority)
    {
        $result = $this->ticketPriorityService->deleteTicketPriority($priority);

        return ApiResponse::withResponseMessage('TicketPriority deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
