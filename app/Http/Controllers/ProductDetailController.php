<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\category;
use App\Models\Brand;
use App\Models\ProductTag;
class ProductDetailController extends Controller
{
    private $review;
    
    public function __construct(Review $review) {
        $this->review = $review;
    }
    

    public function productDetails($slug,$id)   {
        $categorys = category::where('parent_id',0)->where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $productsRecommend = Product::latest('number_of_views','desc')->take(12)->get();
        $product =  Product::where('id',$id)->find($id);
        $product_tags = $product->tags()->get();
        Product::where('id', $id)->update(['number_of_views' => $product->number_of_views+1]);  
        $similar_product = Product::where('category_id',$product->category_id)->whereNotIn('products.id',[$product->id])->take(6)->get();
        $reviews = $this->review->where('product_id',$id)->get();
        return view('pages.product_details',\compact('categorys','brands','productsRecommend','product','product_tags','similar_product','reviews'));
    } 

    public function storeReview(Request $request) {
        
        $this->review->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'content'=>$request->content,
            'product_id'=>$request->product_id
        ]);
            
    }

    public function displayReview(Request $request) {
        $id = $request->product_id;
		$result = $this->review->where('product_id',$id)->orderby('created_at','DESC')->get();
		return response()->json($result);
    }


}
