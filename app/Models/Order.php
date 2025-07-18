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
        return $this->belongsTo(Shipping::class,'shipping_id','id');
    }

    public function orderdetails() {
        return $this->belongsToMany(Orderdetail::class,'order_id','id');
    }

    public function stockout() {
        return $this->belongsTo(Warehouse::class,'stock_out_id','id');
    }

}
