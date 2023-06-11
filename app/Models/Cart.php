<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_detail', 'cart_id', 'product_id')->withTimestamps()->withPivot('cart_detail_quantity', 'cart_detail_price');
    }
}
