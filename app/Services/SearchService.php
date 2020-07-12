<?php
namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;

class SearchService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function sortByType($type, $category_id = null) {
        if ($category_id != null)
            return $this->productRepository->getByTypeWithCategory($category_id, $type);
        else
            return $this->productRepository->getByType($type);
    }

    public function sortByPrice($minPrice, $maxPrice, $category_id = null) {
        if ($category_id != null)
            return $this->productRepository->getByPriceWithCategory($minPrice, $maxPrice, $category_id);
        else
            return $this->productRepository->getByPrice($minPrice, $maxPrice);
    }

    public function searchByNameProduct($key) {
        return $this->productRepository->searchByName($key);
    }
}
