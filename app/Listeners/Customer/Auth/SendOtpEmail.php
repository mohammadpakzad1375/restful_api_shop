<?php

namespace App\Listeners\Customer\Auth;

use App\Events\Customer\Auth\SendOtp;
use App\Mail\Customer\Auth\SendOtpMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOtpEmail
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
    public function handle(SendOtp $event): void
    {
        Mail::to($event->email)
            ->queue((new SendOtpMail($event->otp))->onQueue('otp'));
    }
}
