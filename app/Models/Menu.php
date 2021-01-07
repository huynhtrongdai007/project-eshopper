<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    public function menuChidrent() {
        return $this->hasMany(Menu::class,'parent_id');
     }
}
