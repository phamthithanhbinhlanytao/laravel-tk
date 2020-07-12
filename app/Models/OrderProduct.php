<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'orders_products';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
    ];
}
