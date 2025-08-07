<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinces;
use App\Models\District;
use App\Models\Ward;
use App\Models\Feeship;
use Illuminate\Support\Facades\Log;

class FeeshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeships = Feeship::orderBy('created_at')->get();
        return view('admin.modules.feeship.index',compact('feeships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = provinces::all();
        return view('admin.modules.feeship.create',compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $feeship = Feeship::create([
            'province_code'=>$data['province_code'],
            'district_code'=>$data['district_code'],
            'ward_code'=>$data['ward_code'],
            'fee_ship'=>$data['fee_ship'],
        ]);

          if($feeship) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Thêm Feeship thành công'
                ]);
            }
            
        } catch (\Throwable $exception) {
             Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());
            return response()->json([
                 'code' => 500,
                 'message' => 'Lỗi xin hãy liên hệ với admin'
             ]);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
           if($data['action'] == 'province') {
                $select_districts = District::where('province_code',$data['code'])->get();
                $output.='<option value="">--- Choose ---</option>';
                foreach ($select_districts as $item) {   
                  $output .='<option value="'.$item['code'].'">'.$item['full_name'].'</option>';
                }
            }else{
                $select_wards = Ward::where('district_code',$data['code'])->get();
                $output.='<option value="">--- Choose ---</option>';
                foreach ($select_wards as $item) {
                    $output .='<option value="'.$item['code'].'">'.$item['full_name'].'</option>';
                }
            }
        }
        return $output;
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
        //
    }
}
