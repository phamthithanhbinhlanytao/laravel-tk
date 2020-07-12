<?php
namespace App\Services;

use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;

class MenuService
{
    protected $categoryRepository;
    protected $productRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function menuHeader() {
        $categories = $this->categoryRepository->getAllWithChildren();
        $sales = $this->productRepository->getSalesInTime();

        return [
            'categories' => $categories,
            'sales' => $sales,
        ];
    }
}
