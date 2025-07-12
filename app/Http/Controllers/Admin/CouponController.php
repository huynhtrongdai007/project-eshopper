<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Log;

class CouponController extends Controller
{
    public function __construct(Coupon $coupon) {
        $this->coupon = $coupon;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = $this->coupon->orderBy('id','DESC')->get();
        return view('admin.modules.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.modules.coupon.create');
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
            'code' => 'required|min:5',
            'coupon_time' => 'required',
            'coupon_condition' => 'required',
            'coupon_number' => 'required'
        ]);
        $data = $request->all();
        $this->coupon->create($data);
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
        //
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
        //
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
             $this->coupon->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
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
