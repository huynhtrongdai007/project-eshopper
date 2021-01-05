<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Shipping;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Orderdetail;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                'customer_id' => $request->customer_id,
                'shipping_id' => $shipping_id->id,
                'payment_id' => $payment_id->id,
                'total' => $request->total
            ]);
             Session::put('order_id',$order_id);
            $Cart = Session::get('Cart')->products;
            foreach ($Cart as  $items) {
              
                $order_detail['order_id'] = $order_id->id;
                $order_detail['product_id'] = $items['productInfo']->id;
                $order_detail['name'] = $items['productInfo']->name;
                $order_detail['price'] = $items['productInfo']->price;
                $order_detail['sales_quantity'] = $items['quantity'];
                $order_detail['created_at'] = new DateTime();
                $this->order_detail->insert($order_detail);
                
            }
            Session::forget('Cart');
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());
        }
        
    
    }
}
