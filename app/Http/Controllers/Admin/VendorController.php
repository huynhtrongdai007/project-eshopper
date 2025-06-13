<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{

    private $vendor;

    public function __construct(Vendor $vendor) {
        $this->vendor = $vendor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::all();
        return view('admin.modules.vendor.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.vendor.create');
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
            'name' => 'required|min:3',
            'phone' => 'required|max:10',
            'email' => 'unique:vendors',
        ]);

        $this->vendor->create([
            'name'=> $request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
        ]);

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
        $vendor = Vendor::find($id);
        return view('admin.modules.vendor.edit',\compact('vendor'));
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
            'name' => 'required|min:3',
            'phone' => 'required|max:10',
        ]);

        $this->vendor->find($id)->update([
            'name'=> $request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
        ]);

        return \back()->with('message','Updated SuccesssFully'); 
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
            Vendor::find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'message'
            ]);
        } catch (\Throwable $th) {
            Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());
            return response()->json([
                 'code' => 500,
                 'message' => 'fail'
             ]);
        }
    }
}
