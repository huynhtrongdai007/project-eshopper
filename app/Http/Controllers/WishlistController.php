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
        $dataProduct =  $this->product->find($addproductid);
        $this->wishlist->create([
            'product_id'=>$dataProduct->id,
            'customer_id'=>$customer_id
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Đã thêm sản phẩm yêu thích'
        ]);
    }

    public function removeWishlist(Request $request) {
        $customer_id = Session::get('customer_id');
        $product_id  = $request->product_id;
        $wishlistItem = $this->wishlist
        ->where('product_id',$product_id)
        ->where('customer_id',$customer_id)
        ->first();

        if($wishlistItem) {
            $wishlistItem->delete();
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status' => 'not_found'], 404);
        }
    }

    public function deleteWishlist(Request $request) {
        $id = $request->id;
        $this->wishlist->find($id)->delete();
    }

}
