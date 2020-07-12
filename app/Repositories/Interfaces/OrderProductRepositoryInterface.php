<?php

namespace App\Repositories\Interfaces;

interface OrderProductRepositoryInterface
{
    public function placeOrder($order_id);
}
