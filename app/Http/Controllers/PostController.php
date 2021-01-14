<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postList()
    {
        return view('pages.list_post');
    }
}
