<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Post extends Model
{
    protected $guarded = [];

    public function tags() {
        return $this->belongsToMany(Tag::class,'post_tags','post_id','tag_id')->withTimestamps();
    } 

    public function category() {
        return $this->belongsTo(category::class,'category_id');

    }

    public function users() {
        return $this->belongsTo(User::class,'user_id');
    }
 }
