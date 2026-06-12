<?php

namespace App\Observers\Admin\Market;


use App\Models\Market\Order;

class OrderObserver
{
    /**
     * Handle the Order "creating" event.
     */
    public function creating(Order $order): void
    {
        $order->code ??= $order->generateOrderCode();
    }
}
