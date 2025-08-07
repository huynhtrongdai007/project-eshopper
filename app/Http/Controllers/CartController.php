<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Components\Cart;
use App\Models\Coupon;
use Session;


class CartController extends Controller
{

   public function AddCart(Request $request,$id) {
   
    $product =  Product::where('id',$id)->first(); 
        if($product != null) {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->AddCart($product,$id);
            $request->Session()->put('Cart',$newCart);
            
        }
        return view('pages.cart',\compact('newCart'));
   }

   public function DeleteItemCart(Request $request,$id) {
   
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->DeleteItemCart($id);
        if(\count($newCart->products) > 0) {
            $request->Session()->put('Cart',$newCart);
        } else {
            $request->Session()->forget('Cart');
        }

        return view('pages.cart',\compact('newCart'));
   }
   
   public function SaveItemCart(Request $request,$id,$quantity) {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->UpdateItemCart($id,$quantity);
        $request->Session()->put('Cart',$newCart);
        return view('pages.cart');
   }

   public function SaveAllItemCart(Request $request) {
    foreach($request->data as $item) {

        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->UpdateItemCart($item['key'],$item['value']);
        $request->Session()->put('Cart',$newCart);

    }
        return view('pages.cart');
   }

    public function check_coupon(Request $request) {
        $coupon = Coupon::where('code',$request->coupon_code)->first();
        if($coupon) {
           $coupon_session = Session::has('coupon');
           if ($coupon_session) {
            $cou[] = [
                'coupon_code' => $coupon->code,
                'coupon_condition' => $coupon->coupon_condition,
                'coupon_number' =>  $coupon->coupon_number,
            ];
            Session::put('coupon', $cou);
            return redirect()->back()->with('message', 'success');
           }else{
             $cou[] = [
                'coupon_code' => $coupon->code,
                'coupon_condition' => $coupon->coupon_condition,
                'coupon_number' =>  $coupon->coupon_number,
            ];
            Session::save();
            Session::put('coupon', $cou);
           }
           return redirect()->back()->with('message', 'success');
        }else{
            return redirect()->back()->with('message', 'error');
        }
    }
}
