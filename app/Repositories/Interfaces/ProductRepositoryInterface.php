<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getHotTrend();

    public function showDetail($product_id);

    public function getByCategoryId($category_id);

    public function getSalesInTime();

    public function getOutSales();

    public function getPaginateByCategoryId($category_id);

    public function findWithSales($product_id);

    public function getByType($type);

    public function getByTypeWithCategory($category_id, $type);

    public function getByPrice($minPrice, $maxPrice);

    public function getByPriceWithCategory($minPrice, $maxPrice, $category_id);

    public function searchByName($key);

    public function getWithCategory();
}
