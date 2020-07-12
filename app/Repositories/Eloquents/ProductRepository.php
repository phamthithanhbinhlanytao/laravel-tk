<?php
namespace App\Repositories\Eloquents;

use Carbon\Carbon;
use App\Models\Product;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    public function getHotTrend() {
        $now = Carbon::now();
        $products = Product::withCount('orders')
        ->whereHas('orders', function($query) use ($now) {
            $query->whereYear('created_at', $now->year)
                ->whereMonth('created_at', $now->month);
        })->orderBy('orders_count', 'DESC')
        ->take(config('setting.hot_trend_limit'))->get();

        return $products;
    }

    public function showDetail($product_id) {
        return Product::with('images')->find($product_id);
    }

    public function getByCategoryId($category_id) {
        return Product::where('category_id', $category_id)->get();
    }

    public function getSalesInTime() {
        $now = Carbon::now()->toDateString();
        $queryInTime = function($query) use ($now) {
            $query->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now);
        };

        return Product::with(['sales' => $queryInTime])
        ->whereHas('sales', $queryInTime)->get();
    }

    public function getOutSales() {
        $now = Carbon::now()->toDateString();
        $queryInTime = function($query) use ($now) {
            $query->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now);
        };

        return Product::whereDoesntHave('sales', $queryInTime)
        ->orderBy('price', 'DESC')
        ->paginate(config('setting.paginate_products'));
    }

    public function getPaginateByCategoryId($category_id) {
        return Product::where('category_id', $category_id)
            ->orderBy('price', 'DESC')
            ->paginate(config('setting.paginate_products'));
    }

    public function findWithSales($product_id) {
        $now = Carbon::now()->toDateString();

        return Product::with(['sales' => function($query) use ($now) {
            $query->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now);
        }])->find($product_id);
    }

    public function getByType($type) {
        $now = Carbon::now()->toDateString();
        $queryInTime = function($query) use ($now) {
            $query->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now);
        };

        return Product::whereDoesntHave('sales', $queryInTime)
        ->orderBy('price', $type)
        ->paginate(config('setting.paginate_products'));
    }

    public function getByTypeWithCategory($category_id, $type) {
        return Product::where('category_id', $category_id)
            ->orderBy('price', $type)->paginate(config('setting.paginate_products'));
    }

    public function getByPrice($minPrice, $maxPrice) {
        $now = Carbon::now()->toDateString();
        $queryInTime = function($query) use ($now) {
            $query->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now);
        };

        return Product::whereDoesntHave('sales', $queryInTime)
            ->where('price', '>=', $minPrice)
            ->where('price', '<=', $maxPrice)
            ->orderBy('price', 'DESC')
            ->paginate(config('setting.paginate_products'));
    }

    public function getByPriceWithCategory($minPrice, $maxPrice, $category_id) {
        return Product::where('category_id', $category_id)
            ->where('price', '>=', $minPrice)
            ->where('price', '<=', $maxPrice)
            ->orderBy('price', 'DESC')
            ->paginate(config('setting.paginate_products'));
    }

    public function searchByName($key) {
        return Product::where('name', 'like', '%' . $key . '%')->get();
    }

    public function getWithCategory() {
        return Product::with('category')
            ->where('rating', '>=', '4.5')
            ->where('rating', '<=', '5')
            ->take(20)->get();
    }
}
