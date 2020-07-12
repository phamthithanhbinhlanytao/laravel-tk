<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAllWithChildren();

    public function getWithLatest();
}
