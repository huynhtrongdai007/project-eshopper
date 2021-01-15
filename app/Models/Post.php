<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function tags() {
        return $this->belongsToMany(Tag::class,'post_tags','post_id','tag_id')->withTimestamps();
    } 

    public function category() {
        return $this->belongsTo(category::class,'category_id');

    }
}
