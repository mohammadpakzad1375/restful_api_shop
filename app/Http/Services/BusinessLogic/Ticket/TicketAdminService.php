<?php

namespace App\Http\Services\BusinessLogic\Ticket;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Ticket\TicketAdmin;
use App\Models\User\User;

class TicketAdminService
{
    public function showAllTicketAdmins(): ServiceResult
    {
        return app(ServiceWrapper::class)(function () {

            return User::whereHas('ticketAdmin')->paginate(15);

        });
    }

    public function toggleTicketAdmin(User $admin): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($admin){

            $ticketAdmin = TicketAdmin::withTrashed()
                ->where('user_id', $admin->id)
                ->first();

            if (!$ticketAdmin) {

                return TicketAdmin::create([
                    'user_id' => $admin->id,
                ]);

            } elseif ($ticketAdmin->trashed()) {

                if($ticketAdmin->restore())
                    return $ticketAdmin;

            } else {

                return $ticketAdmin->delete();

            }
        });
    }
}
