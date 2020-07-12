<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Enums\ProductEnums;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'picture',
        'description',
        'price',
        'rating',
        'amount',
        'status',
        'category_id'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_products', 'product_id', 'order_id');
    }

    public function images()
    {
        return $this->hasMany(ImageProduct::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'products_users_rating', 'user_id', 'product_id');
    }

    public function getStatusAttribute($status)
    {
        return $status == ProductEnums::InStock
        ? ProductEnums::fromValue(ProductEnums::InStock)->description
        : ProductEnums::fromValue(ProductEnums::OutOfStock)->description;
    }

    public function getPriceAttribute($price)
    {
        return number_format($price, 2, '.', '');
    }

    public function setRatingAttribute($rating)
    {
        $this->attributes['rating'] = number_format($rating, 2, '.', '');
    }
}
