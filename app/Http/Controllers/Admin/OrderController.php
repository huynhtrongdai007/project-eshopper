<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderdetail;
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
        $orderdetail = $this->orderdetail->all();
        return view('admin.modules.order.show',\compact('orderdetail'));
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
