<?php
namespace App\Repositories\Eloquents;

use Carbon\Carbon;
use App\Models\ProductUserRating;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\ProductUserRatingRepositoryInterface;

class ProductUserRatingRepository extends BaseRepository implements ProductUserRatingRepositoryInterface
{
    public function getModel()
    {
        return ProductUserRating::class;
    }

    public function countRatingByProductId($product_id) {
        return ProductUserRating::where('product_id', $product_id)->count();
    }

    public function getMediumRating($productId) {
        $arrRating = ProductUserRating::select('rating_point')->where('product_id', $productId)->get();
        $count = 0;
        foreach ($arrRating as $point) {
            $count += $point->rating_point;
        }
        return $count / $arrRating->count();
    }

    public function getWithUser($productId) {
        return ProductUserRating::with('user')->where('product_id', $productId)->get();
    }
}
