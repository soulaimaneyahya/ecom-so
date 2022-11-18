<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Facades\Cache;

class OrderObserver
{
    /**
     * Handle the Order "creating" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function creating(Order $order)
    {
        Cache::forget("orders-count");
    }

    /**
     * Handle the Order "deleting" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleting(Order $order)
    {
        Cache::forget("orders-count");
    }

    /**
     * Handle the Order "restoring" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restoring(Order $order)
    {
        Cache::forget("orders-count");
    }
}
