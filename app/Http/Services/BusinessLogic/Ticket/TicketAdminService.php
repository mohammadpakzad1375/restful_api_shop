<?php

namespace App\Http\Services\BusinessLogic\Ticket;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Ticket\TicketAdmin;
use App\Models\User;

class TicketAdminService
{
    public function toggleTicketAdmin(User $admin): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($admin){

            $ticketAdmin = TicketAdmin::where('user_id', $admin->id)->first();

            return $ticketAdmin ? $ticketAdmin->delete() : TicketAdmin::create(['user_id' => $admin->id]);
        });
    }
}
