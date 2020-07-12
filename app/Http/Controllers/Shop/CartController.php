<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;

class CartController extends Controller
{
    protected $cartService;
    protected $categoryRepository;

    public function __construct(
        CartService $cartService,
        CategoryRepository $categoryRepository) {
        $this->cartService = $cartService;
        $this->categoryRepository = $categoryRepository;
    }

    public function index() {
        $categories = $this->categoryRepository->getAllWithChildren();

        return view('shop.cart.index', compact('categories'));
    }

    public function cart(Request $request) {
        $addCart = $this->cartService->addProductToCart($request->product_id, $request->amount);
        if (isset($addCart))

            return redirect()->back()->with(config('setting.key_add_cart'), trans('messages.add_cart_success'))->withInput();
        else

            return redirect()->back()->with(config('setting.key_add_cart'), trans('messages.add_cart_fail'))->withInput();
    }

    public function updateCart(Request $request) {
        foreach ($request->toArray() as $key => $amount) {
            if ($key != config('setting.key_token')) {
                $updateCart = $this->cartService->update($key, $amount);
                if (!isset($updateCart))
                    return redirect()->back()->with(config('setting.key_update_cart'), trans('messages.update_cart_fail'))->withInput();
            }
        }

        return redirect()->back()->with(config('setting.key_update_cart'), trans('messages.update_cart_success'))->withInput();
    }

    public function fastingAdd($product_id) {
        $addCart = $this->cartService->addProductToCart($product_id, config('setting.default_quantify'));
        if (isset($addCart))

            return redirect()->back()->with(config('setting.key_add_cart'), trans('messages.add_cart_success'))->withInput();
        else

            return redirect()->back()->with(config('setting.key_add_cart'), trans('messages.add_cart_fail'))->withInput();
    }

    public function removeProduct($product_id) {
        $result = $this->cartService->remove($product_id);
        if($result)

            return redirect()->back()->with(config('setting.key_remove_cart'), trans('messages.remove_cart_success'))->withInput();
        else

            return redirect()->back()->with(config('setting.key_remove_cart'), trans('messages.remove_cart_fail'))->withInput();
    }
}
