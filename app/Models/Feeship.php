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
}
