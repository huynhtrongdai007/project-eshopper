<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\category;
use App\Models\Brand;
class HomeController extends Controller
{
    public function index() {
        $sliders = Slide::latest()->get();
        $categorys = category::where('parent_id',0)->get();
        $brands = Brand::latest()->get();
        return view('pages.home',\compact('sliders','categorys','brands'));
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
