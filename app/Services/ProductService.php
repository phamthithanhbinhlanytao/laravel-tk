<?php
namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\ProductUserRatingRepositoryInterface as ProductUserRatingRepository;

class ProductService
{
    protected $productRepository;
    protected $productUserRatingRepository;

    public function __construct(
        ProductRepository $productRepository,
        ProductUserRatingRepository $productUserRatingRepository) {
        $this->productRepository = $productRepository;
        $this->productUserRatingRepository = $productUserRatingRepository;
    }

    public function getHotTrend() {
        return $this->productRepository->getHotTrend();
    }

    public function getWithCategory() {
        return $this->productRepository->getWithCategory();
    }

    public function rating($point, $userId, $productId, $content) {
        return $this->productUserRatingRepository->create([
            'product_id' => $productId,
            'user_id' => $userId,
            'rating_point' => $point,
            'content' => $content
        ]);
    }

    public function getMediumRating($productId) {
        return $this->productUserRatingRepository->getMediumRating($productId);
    }

    public function updateRating($productId, $point) {
        return $this->productRepository->update($productId, [
            'rating' => $point
        ]);
    }
}
