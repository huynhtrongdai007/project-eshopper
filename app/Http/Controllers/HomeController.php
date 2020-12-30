<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\category;
use App\Models\Brand;
use App\Models\Product;
class HomeController extends Controller
{

    public function __construct() {
        $categorys = category::where('parent_id',0)->where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $productsRecommend = Product::latest('number_of_views','desc')->take(12)->get();

        view()->share('categorys',$categorys);
        view()->share('brands',$brands);
        view()->share('productsRecommend',$productsRecommend);
    }


    public function index() {
        $sliders = Slide::latest()->get();
        $products = Product::latest()->get()->take(6);
        return view('pages.home',\compact('sliders','products'));
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
        return view('pages.product_details',\compact('product'));
    } 
}
