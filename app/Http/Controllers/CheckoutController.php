<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Shipping;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Provinces;
use App\Models\District;
use App\Models\Ward;
use App\Models\Feeship;
use Session;
use DateTime;
use DB;
class CheckoutController extends Controller
{
    private $shipping;
    private $payment;
    private $order;
    private $order_detail;

    public function __construct(Shipping $shipping,Payment $payment,Order $order, Orderdetail $order_detail) {
        $this->shipping = $shipping;
        $this->payment = $payment;
        $this->order = $order;
        $this->order_detail = $order_detail;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCheckout(Request $request)
    {
        try {
            DB::beginTransaction();
            $shipping_id = $this->shipping->create([
                'customer_id' => $request->customer_id,
                'lastname' => $request->lastname,
                'middlename' => $request->middlename,
                'firstname' => $request->firstname,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'note' => $request->note
            ]);
            $payment_id = $this->payment->create([
                'method' => $request->method
            ]);
    
            //insert order 
            $order_code = substr(md5(microtime()),rand(0,26),5);
            $order_id = $this->order->create([
                'order_code' => $order_code,
                'customer_id' => 7,
                'shipping_id' => $shipping_id->id,
                'payment_id' => $payment_id->id,
                'total' => $request->total,
                'status' => 1
            ]);
      
           
            Session::put('order_id',$order_id);
            $Cart = Session::get('Cart')->products;
            foreach ($Cart as $item) {
                $order_detail['order_id'] = $order_id->id;
                $order_detail['product_id'] = $item['productInfo']->id;
                $order_detail['name'] = $item['productInfo']->name;
                $order_detail['price'] = $item['productInfo']->price;
                $order_detail['sales_quantity'] = $item['quantity'];
                $order_detail['created_at'] = new DateTime();
                $this->order_detail->insert($order_detail);
            }
            Session::forget('Cart');
            DB::commit();
            return "Bạn đã thanh toán thành công";
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());
        }
    }

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

    public function calculatorFeeship(Request $request){
        $data = $request->all();
        if ($data['province_code']) {
           $feeship = Feeship::where('province_code',$data['province_code'])->where('district_code',$data['district_code'])->where('ward_code',$data['ward_code'])->first();
           Session::put('feeship',$feeship->fee_ship);
           if(Session::has('feeship')) {
                return 'find feeship';
           }else{
             return 'No feeship';
           }
        
        }
    }
}