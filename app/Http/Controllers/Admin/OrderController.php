<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderdetail;
use Illuminate\Support\Facades\Log;
class OrderController extends Controller
{
    private $order;
    private $orderdetail;

    public function __construct(Order $order,Orderdetail $orderdetail) {
        $this->order = $order;
        $this->orderdetail = $orderdetail;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->order->latest()->get();
     
        return view('admin.modules.order.index',\compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderdetail = $this->orderdetail->where('order_id',$id)->get();
        $order = $this->order->find($id);
        return view('admin.modules.order.show',\compact('orderdetail','order'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = $this->order->find($id);
        $order->orderdetails()->detach();


        // try {

        //     $this->order->find($id)->delete();
        //      return response()->json([
        //          'code' => 200,
        //          'message' => 'success'
        //      ]);
        //  } catch (\Throwable $th) {
        //      Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());
 
        //      return response()->json([
        //          'code' => 500,
        //          'message' => 'fail'
        //      ]);
        //  }
    }
}
