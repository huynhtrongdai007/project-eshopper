<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Components\Cart;
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

}
