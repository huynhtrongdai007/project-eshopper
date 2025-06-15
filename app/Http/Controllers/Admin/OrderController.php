<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\StockOut;
use App\Models\StockOutDetail;
use Illuminate\Support\Facades\Log;
use PDF;

class OrderController extends Controller
{
    private $order;
    private $orderdetail;
    private $stock_out;
    private $stock_out_detail;

    public function __construct(Order $order, Orderdetail $orderdetail, StockOut $stock_out,StockOutDetail $stock_out_detail)
    {
        $this->order = $order;
        $this->orderdetail = $orderdetail;
        $this->stock_out = $stock_out;
        $this->stock_out_detail = $stock_out_detail;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->order->latest()->get();
        return view("admin.modules.order.index", \compact("orders"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderdetail = $this->orderdetail->where("order_id", $id)->get();
        $order = $this->order->find($id);
        return view(
            "admin.modules.order.show",
            \compact("orderdetail", "order")
        );
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

    public function print_order($order_id)
    {
        $pdf = \App::make("dompdf.wrapper");
        $pdf->loadHTML($this->print_order_convert($order_id));
        return $pdf->stream();
    }

    public function print_order_convert($order_id)
    {
        $getOrderDetail = $this->orderdetail->getByCodeOrderDetail($order_id);
        $customer = $this->orderdetail->getCustomerByCodeOrder($order_id);
        $output = "";

        $output .=
            '
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <style>body{font-family:Dejavu Sans;}</style>
        <h1 align="center">CÔNG TY CNHH MỘT THÀNH VIÊN ABC</h1>   
        <table class="table mt-5" border="1px">    
          <thead>
              <tr>
                 <th>tên khách hàng</th>
                 <th>địa chỉ</th>
                 <th>số điên thoại</th>
              </tr>
        </thead>
           <tbody>
         
              <tr>
                <td with>' .
            $customer->lastname .
            $customer->middlename .
            $customer->firstname .
            '</td>
                <td with="20%">' .
            $customer->address .
            '</td>
                <td>' .
            $customer->phone .
            '</td>
              </tr>
            
          </tbody>
         </table>
        <table border="1px" class="table">
         <thead  with="100%">
             <tr>
                 <th>tên sản phẩm</th>
                 <th>Số Lượng</th>
                 <th>Giá</th>
                 <th>Tổng Tiền</th>
              </tr>
      <tbody>';
        foreach($getOrderDetail as $key => $items){ 
        $output.=
        '<tr>
          <td with="30%">'.$items->product_name.'</td>
          <td >'.$items->qty.'</td>
          <td with="30%">'.number_format($items->price).'</td>
          <td>'.number_format($items->qty * $items->price).'</td>
        </tr>';

      }
        $output.='<tr>
                <td colspan="4">Tong Thanh Tien:'.$items->total.'</td>

                </tr>
                <tr>
                <td colspan="4">Ma don hang:'.$items->order_code.'</td>
                </tr>';
            $output.='
        </tbody>
        </table>';

                $output .= '
        <p style="float:left ;margin-top:90px;">Người Lập Phiếu</p>  
        <p style="float:right;margin-top:1px;">Người Nhận</p>
        ';
                return $output;
    }

    public function confirm_order($id) {
        try {
            DB::beginTransaction();
            $confirmed =  $this->order->find($id)->update([
                'status'=> 1
            ]);

            if($confirmed){
                $order = $this->order->find($id);
                $order_details = $this->orderdetail->where('order_id','=',$order->id)->get();
                $stock_out =  $this->stock_out->create([
                    'stock_code'=>$order->order_code,
                    'order_id'=> $order->id,
                    'user_id'=> auth()->id(),
                    'recipient_id' => $order->customer_id
                ]);

                foreach ($order_details as $item) {
                    $this->stock_out_detail->create([
                        'stock_out_id'=> $stock_out->id,
                        'product_id' => $item->product_id,
                        'quantity'=>$item->sales_quantity,
                        'unit_price' =>$item->price,
                        'total_price'=> $item->sales_quantity * $item->price,
                    ]);
                }
                DB::commit();
                return "Đơn hàng đã được duyệt";
            }
        } catch (\Throwable $exception) {
            DB::rollBack();
            Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());
        }    
    }
}