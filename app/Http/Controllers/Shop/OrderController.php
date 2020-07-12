<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use App\Jobs\SendMailOrder;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    protected $menuService;
    protected $orderService;

    public function __construct(
        MenuService $menuService,
        OrderService $orderService) {
        $this->menuService = $menuService;
        $this->orderService = $orderService;
    }
    public function index() {
        $menuHeader = $this->menuService->menuHeader();
        $categories = $menuHeader['categories'];

        return view('shop.order.index', compact('categories'));
    }

    public function store(OrderRequest $request) {
        $result = $this->orderService->placeOrder($request);
        $details = [
            'email' => $request->email,
            'fullname' => $request->fullname,
        ];
        if ($result) {
            dispatch(new SendMailOrder($details));

            return redirect()->route('shop.index.index')->with(config('setting.key_order'), trans('messages.order_success'))->withInput();
        } else
            return redirect()->back()->with(config('setting.key_order'), trans('messages.order_fail'))->withInput();
    }
}
