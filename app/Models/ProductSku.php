<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InsideException;


class ProductSku extends Model
{
    protected $fillable = ['title', 'description', 'price', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function decreaseStock($amount)
    {
        if ($amount < 0) {
            throw new InsideException('减库存不可小于0');
        }

        return $this->newQuery()->where('id', $this->id)->where('stock', '>=', $amount)->decrement('stock', $amount);
    }

    public function addStock($amount)
    {
        if ($amount < 0) {
            throw new InsideException('加库存不可小于0');
        }
        $this->increment('stock', $amount);
    }
}
