<?php

namespace App\Listeners\Admin\Market\Copan;

use App\Events\Admin\Market\Copan\CopanCreated;
use App\Mail\Admin\Market\Copan\NewCopanDiscountMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCopanDiscountCreatedEmail
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
    public function handle(CopanCreated $event): void
    {
        $copan= $event->copan;

        Mail::to($copan->user->email)
            ->queue((new NewCopanDiscountMail($copan))->onQueue('mails'));

    }
}
