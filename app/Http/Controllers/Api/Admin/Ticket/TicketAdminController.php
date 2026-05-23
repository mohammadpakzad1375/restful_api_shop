<?php

namespace App\Http\Controllers\Api\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\Admin\AdminApiResourceCollection;
use App\Http\Services\BusinessLogic\Ticket\TicketAdminService;
use App\Http\Services\BusinessLogic\User\AdminUserService;
use App\Http\Services\RestfulApi\ApiResponse\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;

class TicketAdminController extends Controller
{
    private AdminUserService $adminUserService;
    private TicketAdminService $ticketAdminService;

    public function __construct(TicketAdminService $ticketAdminService, AdminUserService $adminUserService)
    {
        $this->adminUserService = $adminUserService;
        $this->ticketAdminService = $ticketAdminService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->adminUserService->showAllAdmins();

        return \App\Http\Services\RestfulApi\Facades\ApiResponse::withData(AdminApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function toggle(Request $request,User $admin, ApiResponse $apiResponse)
    {
        $result = $this->ticketAdminService->toggleTicketAdmin($admin);

        $apiResponse->setResponseMessage(is_bool($result->data) ? 'TicketAdmin deleted successfully.' : 'TicketAdmin created successfully.');
        !is_bool($result->data) && $apiResponse->setData($result->data);
        return $apiResponse->response($result->success);

    }
}
