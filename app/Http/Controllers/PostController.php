<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Brand;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Comment;
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

    public function add_comment(Request $request) {
        
        $insertData = Comment::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'comment'=>$request->comment,
            'parent_id'=>$request->parent_id
        ]);
    }

    public function displayCommemnt() {
        $dataComments = Comment::where('parent_id',0)->latest()->get();
        $output='';
        foreach($dataComments as $comment) {
            $output.='<li class="media"> 
            <a class="pull-left" href="#">
                <img class="media-object" src="'.\asset('frontend/images/blog/man-two.jpg').'" alt="">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>'.$comment->name.'</li>
                    <li><i class="fa fa-clock-o"></i>'.date('H:i:s', strtotime($comment->created_at)).'</li>
                    <li><i class="fa fa-calendar"></i>'.date('d-M-Y', strtotime($comment->created_at)).'</li>
                </ul>
                <p>'.$comment->comment.'.</p>
                <a class="btn btn-primary reply" id="'.$comment->id.'" href="javascript:"><i class="fa fa-reply"></i>Replay</a>
            </div>
        </li>';
        $output.=$this->get_reply_comment($comment->id);
        }
        echo $output;
      
    }

    public function get_reply_comment($parent_id = 0) {
        $dataComments = Comment::where('parent_id',$parent_id)->get();
        $count = $dataComments->count();
        $output='';
        if($count > 0) {
            foreach($dataComments as $row)
            {
            $output .= '
            <li class="media second-media">
            <a class="pull-left" href="#">
                <img class="media-object" src="'.\asset('frontend/images/blog/man-three.jpg').'" alt="">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>'.$row->name.'</li>
                    <li><i class="fa fa-clock-o"></i>'.date('H:i:s', strtotime($row->created_at)).'</li>
                    <li><i class="fa fa-calendar"></i>'.date('d-M-Y', strtotime($row->created_at)).'</li>
                </ul>
                <p>'.$row->comment.'.</p>
                <a class="btn btn-primary reply" href="javascript:"><i class="fa fa-reply"></i>Replay</a>
            </div>
        </li> 
            ';
             $output .= $this->get_reply_comment($row->id);
            }
        }
      
        return $output;
    }
}
