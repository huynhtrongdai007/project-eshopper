<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];
    
    public function permissionsChildrent() {
        
        return $this->hasMany(permission::class,'parent_id');
    }
}
