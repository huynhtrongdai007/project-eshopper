<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function customers() {
        return $this->belongsTo(Customer::class);
    }
    
    public function shippings() {
        return $this->belongsTo(Shipping::class);
    }

    public function order_orderdetail() {
        return $this->belongsToMany(Orderdetail::class);
    }
}
