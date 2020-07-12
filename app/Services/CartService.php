<?php
namespace App\Services;

use Cart;
use App\Traits\FormatCart;
use App\Enums\SaleEnums;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\SaleRepositoryInterface as SaleRepository;

class CartService
{
    use FormatCart;

    protected $productRepository;
    protected $saleRepository;

    public function __construct(
        SaleRepository $saleRepository,
        ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
        $this->saleRepository = $saleRepository;
    }

    public function addProductToCart($product_id, $amount) {
        $isSale = $this->saleRepository->checkProductSale($product_id);
        $product = $this->productRepository->findWithSales($product_id);
        $price = $isSale == SaleEnums::DoesntHaveSale
            ? $product->price
            : $product->price - $product->price * ($product->sales[0]->discount / 100);
        $cartInfo = $this->format($product_id, $product->name, $amount, $price,$product->picture);

        return Cart::add($cartInfo);
    }

    public function update($key, $amount) {
        $product_id = explode('_', $key)[1];
        $rows = Cart::search(function ($cartItem, $rowId) use ($product_id) {
            return $cartItem->id == $product_id;
        });
        $item = $rows->first();

        return Cart::update($item->rowId, $item->qty = $amount);
    }

    public function remove($product_id) {
        $countOldCart = Cart::content()->count();
        $rows = Cart::search(function ($cartItem, $rowId) use ($product_id) {
            return $cartItem->id == $product_id;
        });
        Cart::remove($rows->first()->rowId);
        $countNewCart = Cart::content()->count();

        return $countNewCart < $countOldCart ? true : false;
    }
}
