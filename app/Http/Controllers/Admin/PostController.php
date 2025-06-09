<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Traits\StorareImageTrait;
use Storage;
use DB;
use App\Http\Requests\StorePostRequest;
use App\Models\category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTag;

class PostController extends Controller
{
    use StorareImageTrait;
    
    private $post; 
    private $tag;
    private $postTag;
    private $category;

    public function __construct(Post $post,Tag $tag,PostTag $postTag,category $category) {
        $this->post = $post;
        $this->tag = $tag;
        $this->postTag = $postTag;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->latest()->get();
        return view('admin.modules.post.index',\compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = category::all();
        return view('admin.modules.post.create',\compact('category'));
    }

    public function getCategory($parent_id) {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecursive($parent_id);
        return $htmlOption;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataPostCreate = [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request,'feature_image_path','posts');
            if(!empty($dataUploadFeatureImage)) {
                $dataPostCreate['feature_image'] = $dataUploadFeatureImage['file_name'];
                $dataPostCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $post = $this->post->create($dataPostCreate);
    
            //insert tags for post
    
            foreach($request->tags as $tagItem) {
                //Insert to tags
                 $tagIntance = $this->tag->firstOrCreate([
                    'name' => $tagItem
                ]);
                $tagIds[] = $tagIntance->id;
            }
            $post->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('admin.post.create')->with('message','Insered SuccessFully');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Message:'.$th->getMessage().'  Line : ' . $th->getLine());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->post->find($id);
        $categorys = $this->category->all();
        return view('admin.modules.post.edit',\compact('post','categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataPostCreate = [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request,'feature_image_path','posts');
            if(!empty($dataUploadFeatureImage)) {
                $dataPostCreate['feature_image'] = $dataUploadFeatureImage['file_name'];
                $dataPostCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->post->find($id)->update($dataPostCreate);
            $post = $this->post->find($id);
            //insert tags for post
            $tagIds = [];
            if(!empty($request->tags)) {
                foreach($request->tags as $tagItem) {
                    //Insert to tags
                     $tagIntance = $this->tag->firstOrCreate([
                        'name' => $tagItem
                    ]);
                    $tagIds[] = $tagIntance->id;
                }
            }
          
            $post->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('admin.post.index')->with('message','Updated SuccessFully');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Message:'.$th->getMessage().'  Line : ' . $th->getLine());
        }
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->post->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ],200);

        }catch(\Exception $exception) {
            Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());

            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ],500);
        }
    }
}
