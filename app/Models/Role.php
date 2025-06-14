<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];
    
   public function permissions() {
       return $this->belongsToMany(Permission::class,'permission_role','permission_id','role_id');
   }
}
