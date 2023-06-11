<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class, 'product_id', 'id');
    }

    public function productComments()
    {
        return $this->hasMany(ProductComment::class, 'product_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id')->withTimestamps();
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_detail', 'product_id', 'cart_id')->withTimestamps()->withPivot('cart_detail_quantity', 'cart_detail_price');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_detail', 'product_id', 'order_id')->withTimestamps()->withPivot('order_detail_quantity');
    }
}
