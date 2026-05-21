<?php

namespace App\Http\Controllers\Api\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Ticket\TicketCategory\TicketCategoryStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Ticket\TicketCategory\TicketCategoryUpdateApiRequest;
use App\Http\Services\BusinessLogic\Ticket\TicketCategoryService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Ticket\TicketCategory;

class TicketCategoryController extends Controller
{
    public function __construct(private TicketCategoryService $ticketCategoryService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->ticketCategoryService->showAllTicketCategories();

        return ApiResponse::withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketCategoryStoreApiRequest $request)
    {
        $result = $this->ticketCategoryService->createTicketCategory($request->validated());

        return ApiResponse::withResponseMessage('TicketCategory created successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketCategory $category)
    {
        return ApiResponse::withData($category)
            ->build()
            ->response((bool) $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketCategoryUpdateApiRequest $request, TicketCategory $category)
    {
        $result = $this->ticketCategoryService->updateTicketCategory($request->validated(), $category);

        return ApiResponse::withResponseMessage('TicketCategory updated successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketCategory $category)
    {
        $result = $this->ticketCategoryService->deleteTicketCategory($category);

        return ApiResponse::withResponseMessage('TicketCategory deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
