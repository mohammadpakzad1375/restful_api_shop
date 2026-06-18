<?php

namespace App\Listeners\Admin\Notify\Email;

use App\Events\Admin\Notify\Email\EmailCreated;
use App\Mail\Admin\Notify\Email\GeneralMail;
use App\Models\User\User;
use Illuminate\Support\Facades\Mail;

class SendEmailToCustomers
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
    public function handle(EmailCreated $event): void
    {
        $email = $event->email;

        User::customer()
            ->chunkById(500, function ($customers) use ($email) {

                foreach ($customers as $customer) {

                    Mail::to($customer->email)
                        ->later($email->published_at, (new GeneralMail($email))->onQueue('mails'));

                }

            });
    }
}
