<?php
namespace App\Repositories\Eloquents;

use App\Models\Order;
use App\Enums\OrderStatus;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }

    public function placeOrder($user_id, $total, $address, $note) {
        $order = new Order;
        $order->user_id = $user_id;
        $order->price = $total;
        $order->status = OrderStatus::Ordered;
        $order->address = $address;
        $order->note = $note == null ? '' : $note;
        $order->save();

        return $order->id;
    }
}
