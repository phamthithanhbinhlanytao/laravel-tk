<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use App\Models\Comment;
use App\Models\ProductUserRating;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'password',
        'fullname',
        'birthday',
        'address',
        'phone',
        'avatar',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function products()
    {
        return $this->belongsToMany(User::class, 'products_users_rating', 'user_id', 'product_id');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function productRatings()
    {
        return $this->hasMany(ProductUserRating::class);
    }
}
