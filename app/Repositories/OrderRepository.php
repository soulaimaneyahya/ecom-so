<?php

namespace App\Repositories;

use App\Models\Order;
use App\Interfaces\OrderInterface;

class OrderRepository implements OrderInterface
{
    public function __construct(
        private Order $order,
    ) {
    }

    public function all()
    {
        return $this->order->paginate(5);
    }

    public function count()
    {
        return $this->order->get(['id'])->count();
    }
}
