<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Menu;
use DB;

class HomeController extends Controller
{

    public function __construct() {
        $categorys = category::where('parent_id',0)->where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $productsRecommend = Product::latest('number_of_views','desc')->take(12)->get();
        $menus = Menu::where('parent_id',0)->get();
        view()->share('categorys',$categorys);
        view()->share('brands',$brands);
        view()->share('productsRecommend',$productsRecommend);
        view()->share('menus',$menus);
    }


    public function index() {
        $sliders = Slide::where('status',1)->latest()->get();
        $products = Product::where('status',1)->latest()->get()->take(6);
        $menus = Menu::where('parent_id',0)->get();
        return view('pages.home',\compact('sliders','products','menus'));
    }

    public function login() {
        return view('pages.login');
    }

    public function cart() {
        return view('pages.cart');
    }

    public function checkout() {
        return view('pages.checkout');
    }

    public function storeCheckOut(Request $request) {
        
    }

    public function contact() {
        return view('pages.contact-us');
    }

    public function category($slug,$category_id) {
        $products = Product::where('category_id',$category_id)->paginate(5);
        return view('pages.product.category.list',\compact('products'));
    }

    public function brand($slug,$brand_id) {
        $products = Product::where('brand_id',$brand_id)->paginate(5);
        return view('pages.product.brand.list',\compact('products'));
    }
    
    public function productDetails($slug,$id)   {
        $product =  Product::where('id',$id)->find($id);
        $product_tags = $product->tags()->get();
        Product::where('id', $id)->update(['number_of_views' => $product->number_of_views+1]);  
        $similar_product = Product::where('category_id',$product->category_id)->whereNotIn('products.id',[$product->id])->take(6)->get();
        return view('pages.product_details',\compact('product','product_tags','similar_product'));
    } 

    public function productTags($tag_id) {
        $product = DB::table('products')
        ->join('product_tags','product_tags.product_id','=','products.id')
        ->where('product_tags.tag_id',$tag_id)
		->select('products.*')
		->paginate(5);
        return view('pages.product.tags.list',\compact('product'));
    }

    public function search(Request $request) {
        $search=  $request->term;
        
        $products = Product::where('name','LIKE',"%{$search}%")
                       ->orderBy('created_at','DESC')->limit(5)->get();

        if(!$products->isEmpty())
        {
            foreach($products  as $product)
            {
                
                $new_row['name']= $product->name;
                $new_row['feature_image_path']= $product->feature_image_path;
                $new_row['price'] = $product->price;
                $new_row['url']= url('product-details/'.$product->slug,$product->id);
                
                $row_set[] = $new_row; //build an array
            }
        }
        
        echo json_encode($row_set); 
    }
}
