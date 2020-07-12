<?php

namespace App\Repositories\Interfaces;

interface ProductUserRatingRepositoryInterface
{
    public function countRatingByProductId($product_id);

    public function getMediumRating($productId);

    public function getWithUser($productId);
}
