<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','email_verified','avatar',
    ];

    protected $casts = [
      'email_verified'=>'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'user_favorite_products')   //多对多关联
            ->withTimestamps()  //带有时间戳
            ->orderBy('user_favorite_products.created_at', 'desc');//默认按照时间 倒序排序
    }

    public function cartItems(){

        return $this->hasMany(CartItem::class);
    }
}
