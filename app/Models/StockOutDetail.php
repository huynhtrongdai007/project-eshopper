<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOutDetail extends Model
{
    protected $guarded = [];
    
    public function stoskout() {
        return $this->belongsTo(StockOut::class,'stock_out_id');
    }

    public function product() {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
