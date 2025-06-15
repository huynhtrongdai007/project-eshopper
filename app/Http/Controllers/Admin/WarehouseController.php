<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\StockOut;
use DB;

class WarehouseController extends Controller
{
    private $product;
    private $vendor;
    private $stock_out;
    public function __construct(Product $product, Vendor $vendor,Warehouse $warehouse, StockOut $stockout) {
        $this->product = $product;
        $this->vendor = $vendor;
        $this->warehouse = $warehouse;
        $this->stockout = $stockout;
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
