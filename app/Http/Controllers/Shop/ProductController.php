<?php

namespace App\Http\Controllers\Shop;

use Auth;
use Illuminate\Http\Request;
use App\Enums\SaleEnums;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Repositories\Interfaces\SaleRepositoryInterface as SaleRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\ProductUserRatingRepositoryInterface as ProductUserRatingRepository;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryRepository;
    protected $productRepository;
    protected $saleRepository;
    protected $productUserRatingRepository;

    public function __construct(
        ProductService $productService,
        CategoryRepository $categoryRepository,
        SaleRepository $saleRepository,
        ProductRepository $productRepository,
        ProductUserRatingRepository $productUserRatingRepository) {
        $this->productService = $productService;
        $this->saleRepository = $saleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->productUserRatingRepository = $productUserRatingRepository;
    }

    public function show($product_id) {
        $categories = $this->categoryRepository->getAllWithChildren();
        $isSale = $this->saleRepository->checkProductSale($product_id);
        $product = $this->productRepository->findWithSales($product_id);
        $price = $isSale == SaleEnums::DoesntHaveSale
            ? $product->price
            : $product->price - $product->price * ($product->sales[0]->discount / 100);
        $countReview = $this->productUserRatingRepository->countRatingByProductId($product_id);
        $relatedProducts = $this->productRepository->getByCategoryId($product->category_id);
        $reviews = $this->productUserRatingRepository->getWithUser($product_id);

        return view('shop.product.show', compact('product', 'categories', 'countReview', 'relatedProducts', 'price', 'reviews'));
    }

    public function rating(Request $request) {
        $rating = $this->productService->rating($request->point, Auth::user()->id, $request->product_id, $request->content);
        if($rating) {
            $mediumPoint = $this->productService->getMediumRating($request->product_id);
            $updateRating = $this->productService->updateRating($request->product_id, $mediumPoint);
            if ($updateRating->count())
                return redirect()->back()->with('product_review', trans('messages.thanks_review'));
        }

        return redirect()->back()->with('product_review', trans('messages.review_fail'));
    }
}
