<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Product extends Model
{
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class,'product_tags','product_id','tag_id')->withTimestamps();
    }

    public function category() {
        return $this->belongsTo(category::class,'category_id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function productImages() {
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function  productWishlist() {
        return $this->hasOneThrough(Wishlist::class,'product_id');
        
    }

}
