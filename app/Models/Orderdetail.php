<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $guarded = [];

    public function products() {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function orders() {
        return $this->belongsTo(Order::class,'order_id','id');
    }

}
