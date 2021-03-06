<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Components\Recursive;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use DateTime;

class CategoryController extends Controller
{
    private $category;

    public function __construct(category $category) {
        $this->category = $category;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getcategory = $this->category->all();
        return view('admin.modules.category.index',\compact('getcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $htmlOption = $this->getCategory($parent_id = '');
        return view('admin.modules.category.create',compact('htmlOption'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->category->create([
            'name' =>$request->name,
            'parent_id' =>$request->parent_id,
            'slug' => Str::slug($request->name)
        ]);

        return back()->with('message','Insertd Success');
    }

    public function getCategory($parent_id) {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecursive($parent_id);
        return $htmlOption;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.modules.category.edit',\compact('category','htmlOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->category->find($id)->update([
            'name' =>$request->name,
            'parent_id' =>$request->parent_id,
            'slug' => Str::slug($request->name)
        ]);

       return \redirect()->route('admin.category.index'); 

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
            $this->category->find($id)->delete();
             return response()->json([
                 'code' => 200,
                 'message' => 'success'
             ]);
         } catch (\Exception $exception) {
             Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());
 
             return response()->json([
                 'code' => 500,
                 'message' => 'fail'
             ]);
         }
    }

    public function StatusActive(Request $request) {
        $id = $request->id;
        $this->category->where('id',$id)->update(['status'=>1]);
    }

    public function StatusUntive(Request $request) {
        $id = $request->id;
        $this->category->where('id',$id)->update(['status'=>0]);
    }
}
