<?php

namespace App\Http\Controllers\Shop;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MenuService;
use App\Services\ProductService;

class IndexController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;
    protected $menuService;
    protected $productService;
    protected $categoryService;

    public function __construct(
        MenuService $menuService,
        ProductService $productService) {
        $this->menuService = $menuService;
        $this->productService = $productService;
    }

    public function index()
    {
        $menu = $this->menuService->menuHeader();
        $categories = $menu['categories'];
        $hotTrendProduct = $this->productService->getHotTrend();
        $featureProducts = $this->productService->getWithCategory();

        return view('shop.index.index', compact('categories', 'hotTrendProduct', 'featureProducts'));
    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }
}
