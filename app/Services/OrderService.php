<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;

class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private Order $order,
    ) {
    }

    public function all()
    {
        return $this->orderRepository->all();
    }

    public function count()
    {
        return $this->orderRepository->count();
    }
}
