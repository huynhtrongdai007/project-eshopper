<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Components\MenusRecursive;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    private $menu;
    private $menuRecursive;
    public function __construct(Menu $menu,MenusRecursive $menuRecursive) {
        $this->menu = $menu; 
        $this->menuRecursive = $menuRecursive;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->menu->get();
        return view('admin.modules.menu.index',\compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $optionSelect = $this->menuRecursive->menuRecursiveAdd();
        
        return view('admin.modules.menu.create',\compact('optionSelect'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->menu->create([
            'name' => $request->name,
            'slug' =>  Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);

        return \back()->with('message','Inserted SuccessFully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = $this->menu->find($id);
        $optionSelect = $this->menuRecursive->menuRecursiveEdit($menu->parent_id);

        return view('admin.modules.menu.edit',\compact('menu','optionSelect'));
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
        $this->menu->find($id)->update([
            'name' => $request->name,
            'slug' =>  Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);

        return \back()->with('message','Updated SuccessFully');
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
            $this->menu->find($id)->delete();
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
}
