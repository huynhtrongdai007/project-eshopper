<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Warehouse extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function product() {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
}
