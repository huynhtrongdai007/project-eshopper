<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use Session;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    private $wishlist;

    public function __construct(Wishlist $wishlist,Product $product) {
        $this->wishlist = $wishlist;
        $this->product = $product;
    }
   

    public function addWishList(Request $request) {
        $customer_id = Session::get('customer_id');
        $addproductid = $request->product_id;

        $result = $this->wishlist->where('product_id',$addproductid)->where('customer_id',$customer_id)->get();
        $countId = $result->count();
        if($countId>0) {
            $this->wishlist->where('product_id',$addproductid)->where('customer_id',$customer_id)->delete();
            echo '0';
        }else{
            $dataProduct =  $this->product->find($addproductid);
            $this->wishlist->create([
                'product_id'=>$dataProduct->id,
                'customer_id'=>$customer_id
            ]);
            echo '1';
        }

    }

    public function getWishList(Request $request) {

        $customer_id = Session::get('customer_id');
        $addproductid = $request->product_id;

        $result = $this->wishlist->where('product_id',$addproductid)->where('customer_id',$customer_id)->get();
        $countId = $result->count();
        $output="";
        if($countId > 0) {
            $output.='<i class="fa fa-minus-square">Remove wishlist</i>';
        } else {
            $output.='<i class="fa fa-plus-square">Add to wishlist</i>';
        }

        return $output;

    }

    public function deleteWishlist(Request $request) {
        $id = $request->id;
        $this->wishlist->find($id)->delete();
    }

}
