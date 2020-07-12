<?php
namespace App\Services;

use DB;
use Auth;
use Cart;
use Carbon\Carbon;
use App\Enums\UserRoleEnums;
use App\Repositories\Interfaces\OrderRepositoryInterface as OrderRepository;
use App\Repositories\Interfaces\OrderProductRepositoryInterface as OrderProductRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class OrderService
{
    protected $orderRepository;
    protected $orderProductRepository;
    protected $userRepository;

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        OrderProductRepository $orderProductRepository) {
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->orderProductRepository = $orderProductRepository;
    }

    public function placeOrder($request) {
        DB::beginTransaction();
        try {
            $user_id = Auth::user()->id;
            $order_id = $this->orderRepository
                    ->placeOrder($user_id, $request->total, $request->address, $request->note);
            $this->orderProductRepository->placeOrder($order_id);
            DB::commit();
            Cart::destroy();

            return true;
        } catch (Throwable $e) {
            DB::rollBack();

            return false;
        }
    }
}
