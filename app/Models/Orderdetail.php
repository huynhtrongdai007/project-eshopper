<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Orderdetail extends Model
{
    protected $guarded = [];

    public function products() {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function orders() {
        return $this->belongsTo(Order::class,'order_id','id');
    }

    public function getCustomerByCodeOrder($order_id) {
        $result = DB::table('orders')
        ->join('shippings','shippings.id','=','orders.shipping_id')
        ->where('orders.id',$order_id)
        ->select('shippings.lastname','shippings.middlename','shippings.firstname','shippings.phone','shippings.address')
        ->first();
        return $result;
    }
    

    public function getByCodeOrderDetail($order_id) {
        $result = DB::table('orders')
        ->join('orderdetails','orderdetails.order_id','=','orders.id')
        ->join('products','orderdetails.product_id','=','products.id')
        ->where('orderdetails.order_id',$order_id)
        ->orderby('orders.id','DESC')
        ->select('orders.total','orders.order_code','products.name as product_name','products.price','orderdetails.sales_quantity as qty','products.feature_image_path')
        ->get();
        return $result;
    }

}
