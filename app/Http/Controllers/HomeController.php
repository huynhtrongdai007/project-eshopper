<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\category;
use App\Models\Brand;
use App\Models\Product;
class HomeController extends Controller
{
    public function index() {
        $sliders = Slide::latest()->get();
        $categorys = category::where('parent_id',0)->get();
        $brands = Brand::latest()->get();
        $products = Product::latest()->get()->take(6);
        $productsRecommend = Product::latest('number_of_views','desc')->take(12)->get();
        return view('pages.home',\compact('sliders','categorys','brands','products','productsRecommend'));
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

 
}
