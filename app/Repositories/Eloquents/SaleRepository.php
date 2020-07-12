<?php
namespace App\Repositories\Eloquents;

use Carbon\Carbon;
use App\Models\Sale;
use App\Enums\SaleEnums;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\SaleRepositoryInterface;

class SaleRepository extends BaseRepository implements SaleRepositoryInterface
{
    public function getModel()
    {
        return Sale::class;
    }

    public function checkProductSale($product_id) {
        $now = Carbon::now()->toDateString();
        $queryInTime = function($query) use ($now) {
            $query->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now);
        };
        $sale = Sale::where('product_id', $product_id)
        ->where('start_time', '<=', $now)
        ->where('end_time', '>=', $now)->get();

        return $sale->count() == SaleEnums::DoesntHaveSale
            ? SaleEnums::DoesntHaveSale
            : SaleEnums::HasSale;
    }
}
