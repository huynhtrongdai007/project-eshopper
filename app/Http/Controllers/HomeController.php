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
        $categorys = category::where('parent_id',0)->get();
        $brands = Brand::latest()->get();
        view()->share('categorys',$categorys);
        view()->share('brands',$brands);
    }


    public function index() {
        $sliders = Slide::latest()->get();
        $products = Product::latest()->get()->take(6);
        $productsRecommend = Product::latest('number_of_views','desc')->take(12)->get();
        return view('pages.home',\compact('sliders','products','productsRecommend'));
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
 
}
