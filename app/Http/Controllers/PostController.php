<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Brand;
use App\Models\Post;
use App\Models\PostTag;
use DB;
class PostController extends Controller
{
    public function __construct() {
        $brands = Brand::where('status',1)->get();
        $categorys = category::where('parent_id',0)->where('status',1)->get();
        view()->share('brands',$brands);
        view()->share('categorys',$categorys);
    }

    public function postList()
    {
        $posts = Post::latest()->paginate(3);
        return view('pages.list_post',\compact('posts'));
    }

    public function postDetail($slug,$id) {
        $post = Post::find($id);
        $paginates = Post::simplePaginate(2);
        $post_tags = $post->tags()->get();
        return view('pages.post_detail',\compact('post','paginates','post_tags'));
    }

    public function postTags($tag_id) {

        $posts = DB::table('posts')
        ->join('post_tags','post_tags.post_id','=','posts.id')
        ->join('users','users.id','=','posts.user_id')
        ->where('post_tags.tag_id',$tag_id)
        ->select('posts.*','users.name')
        ->paginate(6);
        return view('pages.post_tags',\compact('posts'));
    }
}
