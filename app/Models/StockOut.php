<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class StockOut extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }

     public function shipping() {
        return $this->belongsTo(Shipping::class, 'recipient_id','id');
    }
}
