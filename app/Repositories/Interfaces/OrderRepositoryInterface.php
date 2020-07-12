<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function placeOrder($user_id, $total, $address, $note);
}
