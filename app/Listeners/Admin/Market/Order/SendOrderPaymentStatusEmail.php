<?php

namespace App\Listeners\Admin\Market\Order;

use App\Events\Admin\Market\Order\OrderPaymentStatusChanged;
use App\Mail\Admin\Market\Order\OrderPaymentStatusMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderPaymentStatusEmail
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
    public function handle(OrderPaymentStatusChanged $event): void
    {
        $order= $event->order;

        Mail::to($order->user->email)
            ->queue((new OrderPaymentStatusMail($order))->onQueue('mails'));
    }
}
