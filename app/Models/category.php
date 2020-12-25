<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['id','name','parent_id','slug'];

    public function categoryChildrent() {
        return $this->hasMany(category::class,'parent_id'); 
    }

    public function products() {
        return $this->hasMany(Product::class,'category_id'); 

    } 
}
