<?php

namespace App\Http\Controllers\Shop;

use App\Enums\SortTypeEnums;
use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Services\SearchService;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;

class SearchController extends Controller
{
    protected $menuService;
    protected $searchService;
    protected $categoryRepository;
    protected $productRepository;

    public function __construct(
        SearchService $searchService,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        MenuService $menuService) {
        $this->menuService = $menuService;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->searchService = $searchService;
    }

    public function sortByType(Request $request) {
        $menuHeader = $this->menuService->menuHeader();
        $categories = $menuHeader['categories'];
        $sales = $menuHeader['sales'];
        $category_id = $request->category_id;
        $categoryName = '';
        $type = $request->sort_bytype == SortTypeEnums::Increase
            ? 'ASC' : 'DESC';
        if ($category_id != null) {
            $categoryName = $this->categoryRepository->find($category_id)->name;
            $products = $this->searchService->sortByType($type, $category_id);
        } else {
            $products = $this->searchService->sortByType($type);
        }

        return view('shop.category.index', compact('categories', 'products','categoryName', 'sales', 'type', 'category_id'));
    }

    public function sortByPrice(Request $request) {
        $menuHeader = $this->menuService->menuHeader();
        $categories = $menuHeader['categories'];
        $sales = $menuHeader['sales'];
        $category_id = $request->category_id;
        $categoryName = '';
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        if ($category_id != null) {
            $categoryName = $this->categoryRepository->find($category_id)->name;
            $products = $this->searchService->sortByPrice($min_price, $max_price, $category_id);
        } else {
            $products = $this->searchService->sortByPrice($min_price, $max_price);
        }
        return view('shop.category.index', compact('categories', 'products','categoryName',
            'sales', 'category_id', 'min_price', 'max_price'));
    }

    public function searchByName(Request $request)
    {
        $products = $this->searchService->searchByNameProduct($request->value);

        return response()->json($products);
    }
}
