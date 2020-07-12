<?php
namespace App\Repositories\Eloquents;

use App\Models\Category;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getAllWithChildren() {
        return Category::with('children')->where('parent_id', 0)->get();
    }

    public function getWithLatest() {
        return Category::with(['products' => function ($query) {
            $query->orderBy('id', 'DESC');
        }])->get();
    }
}
