<?php

namespace App\Listeners\Admin\Market\CommonDiscount;


use App\Events\Admin\Market\CommonDiscount\CommonDiscountCreated;
use App\Mail\Admin\Market\CommonDiscount\NewCommonDiscountMail;
use App\Models\User\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCommonDiscountCreatedEmail
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
    public function handle(CommonDiscountCreated $event): void
    {
        $commonDiscount = $event->commonDiscount;

        User::customer()
            ->chunkById(500, function ($customers) use ($commonDiscount) {

                foreach ($customers as $customer) {

                    Mail::to($customer->email)
                        ->queue((new NewCommonDiscountMail($commonDiscount))->onQueue('mails'));

                }

            });
    }
}
