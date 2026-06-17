<?php

namespace App\Listeners\Admin\Auth;


use App\Events\Admin\Auth\Login;
use App\Notifications\Admin\Auth\AdminLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AdminLoggedIn
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $event->admin->notify(new AdminLogin($event->admin));
    }
}
