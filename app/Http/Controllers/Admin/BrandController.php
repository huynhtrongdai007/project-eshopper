<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    private $brand;

    public function __construct(Brand $brand) {
        $this->brand = $brand;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = $this->brand->all();
        return view('admin.modules.brand.index',\compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3'
        ]);
        $data = $request->except('_token');
        $data['slug'] = Str::slug($request->name);
        $data['created_at'] = new DateTime();
        $this->brand->insert($data);
        return \back()->with('message','Insertd SuccesssFully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = $this->brand->find($id);
        return view('admin.modules.brand.edit',\compact('brand'));
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
        $request->validate([
            'name' => 'required|min:3'
        ]);
        $data = $request->except('_token');
        $data['slug'] = Str::slug($request->name);
        $data['updated_at'] = new DateTime();
        $this->brand->where('id',$id)->update($data);
        return \redirect()->route('admin.brand.index');
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
            $this->brand->find($id)->delete();
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
        $this->brand->where('id',$id)->update(['status'=>1]);
    }

    public function StatusUntive(Request $request) {
        $id = $request->id;
        $this->brand->where('id',$id)->update(['status'=>0]);
    }
}
