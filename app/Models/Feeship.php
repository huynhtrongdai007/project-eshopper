<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    protected $fillable = [
        'province_code',
        'district_code',
        'ward_code',
        'fee_ship',
    ];

    public function province() {
        return $this->belongsTo(Provinces::class,'province_code','code');
    }

    public function district() {
        return $this->belongsTo(District::class,'district_code','code');
    }

    public function ward() {
        return $this->belongsTo(Ward::class,'ward_code','code');
    }
}
