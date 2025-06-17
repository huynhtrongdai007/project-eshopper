<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\StockOut;
use App\Models\StockOutDetail;
use DB;
use Carbon\Carbon;

class WarehouseController extends Controller
{
    private $product;
    private $vendor;
    private $stock_out;
    private $stock_out_detail;

    public function __construct(Product $product,Vendor $vendor,
    Warehouse $warehouse, StockOut $stockout, StockOutDetail $stock_out_detail) {
        $this->product = $product;
        $this->vendor = $vendor;
        $this->warehouse = $warehouse;
        $this->stockout = $stockout;
        $this->stock_out_detail = $stock_out_detail;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->warehouse->orderBy('id','DESC')->get();
        return view('admin.modules.warehouse.index',compact('products'));
    }

    public function stock_out_view() {
       $list_stock_out = $this->stockout->orderBy('id','DESC')->get();
        return view('admin.modules.warehouse.stock_out_view',compact('list_stock_out'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->product->all();
        $vendors = $this->vendor->all();

        return view('admin.modules.warehouse.create',compact('products','vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'product_id' => 'required',
                'vendor_id' => 'required',
                'incoming' => 'required',
            ]);
            $product_warehouse = $this->warehouse->insertGetId([
                'product_id'=> $request->product_id,
                'vendor_id'=> $request->vendor_id,
                'incoming'=> $request->incoming,
            ]);

            $product = $this->product->find($product_warehouse->product_id);

            $this->warehouse->find($product_warehouse->id)->update([
                'on_hand'=> $product->on_hand + $request->incoming,
            ]);

            $this->product->find($product->id)->update([
                'on_hand'=> $product->on_hand + $request->incoming,
            ]);
            DB::commit();
            return \back()->with('message','Incoming SuccesssFully');

        } catch (\Throwable $exception) {
            DB::rollBack();
            Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());
        }
       
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
    public function stock_out_detail_view($id)
    {
        $stock_out = $this->stockout->find($id);
        $stock_out_detail = $this->stock_out_detail->where('stock_out_id','=',$id)->get();
        return view('admin.modules.warehouse.stock_out_detail_view',compact('stock_out','stock_out_detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
     
        $request->validate([
            'stock_date' => 'required',
            'reason' => 'required',
        ]);

        $this->stockout->find($id)->update([
            'stock_date' => $request->stock_date,
            'reason' => $request->reason,
            'note' => $request->note,
        ]);

        return \back()->with('message','Updated SuccesssFully');
    }

    public function confirm_stock_out($id)
    {
        try {
            $stock_out = $this->stockout->find($id);

            if (empty($stock_out) || empty($stock_out->stock_date) || empty($stock_out->reason)) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Yêu cầu chọn ngày và lý do để tiến hành xuất kho'
                ]);
            }

            DB::beginTransaction();

            $stock_out_details = $this->stock_out_detail->where('stock_out_id', $id)->get();

            foreach ($stock_out_details as $item) {
                $product = $this->product->find($item->product_id);
                
                if (!$product) {
                    DB::rollBack();
                    return response()->json([
                        'code' => 404,
                        'message' => "Không tìm thấy sản phẩm ID: {$item->product_id}"
                    ]);
                }

                $new_quantity = $product->on_hand - $item->quantity;

                if ($new_quantity < 0) {
                    DB::rollBack();
                    return response()->json([
                        'code' => 400,
                        'message' => "Sản phẩm '{$product->name}' không đủ tồn kho."
                    ]);
                }

                $product->update([
                    'on_hand' => $new_quantity
                ]);
            }

            $stock_out->update([
                'status' => 1
            ]);

            DB::commit();

            return response()->json([
                'code' => 200,
                'message' => 'Đã xuất kho thành công'
            ]);
        } catch (\Throwable $exception) {
            DB::rollBack();
            Log::error('Message: '.$exception->getMessage().' | Line: '.$exception->getLine());

            return response()->json([
                'code' => 500,
                'message' => 'Đã có lỗi xảy ra. Vui lòng thử lại.'
            ]);
        }
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
