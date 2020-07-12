<?php
namespace App\Repositories\Eloquents;

use Cart;
use App\Models\OrderProduct;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\OrderProductRepositoryInterface;

class OrderProductRepository extends BaseRepository implements OrderProductRepositoryInterface
{
    public function getModel()
    {
        return OrderProduct::class;
    }

    public function placeOrder($order_id) {
        foreach (Cart::content() as $item) {
            $orderProduct = new OrderProduct;
            $orderProduct->order_id = $order_id;
            $orderProduct->product_id = $item->id;
            $orderProduct->amount = $item->qty;

            $orderProduct->save();
        }
    }
}
