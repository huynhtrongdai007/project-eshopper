<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Brand;

class PostController extends Controller
{
    public function postList()
    {
        $categorys = category::where('parent_id',0)->where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        return view('pages.list_post',\compact('categorys','brands'));
    }
}
