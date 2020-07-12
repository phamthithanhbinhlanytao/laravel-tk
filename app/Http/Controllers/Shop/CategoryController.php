<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\ProductUserRatingRepositoryInterface as ProductUserRatingRepository;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;
    protected $productUserRatingRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        ProductUserRatingRepository $productUserRatingRepository) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->productUserRatingRepository = $productUserRatingRepository;
    }

    public function index() {
        $categories = $this->categoryRepository->getAllWithChildren();
        $sales = $this->productRepository->getSalesInTime();
        $products = $this->productRepository->getOutSales();
        $latestProducts = $this->categoryRepository->getWithLatest();

        return view('shop.category.index', compact('categories', 'sales', 'products', 'latestProducts'));
    }

    public function show($category_id) {
        $categories = $this->categoryRepository->getAllWithChildren();
        $sales = $this->productRepository->getSalesInTime();
        $categoryName = $this->categoryRepository->find($category_id)->name;
        $products = $this->productRepository->getPaginateByCategoryId($category_id);
        $latestProducts = $this->categoryRepository->getWithLatest();

        return view('shop.category.show', compact('categories', 'sales', 'products', 'categoryName', 'category_id', 'latestProducts'));
    }
}
