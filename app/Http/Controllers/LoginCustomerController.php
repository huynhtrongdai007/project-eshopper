<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Session;
use Illuminate\Support\Facades\Auth;

class LoginCustomerController extends Controller
{
    private $customer;

    public function __construct(Customer $customer) {
        $this->customer = $customer;
    }
    
    public function registerCustomer(Request $request) {
      $result =  $this->customer->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $request->Session()->put('Customer',$result->id);
    
        return redirect()->route('home');
    }

    public function loginCustomer(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $request->Session()->put('Customer',$credentials);
        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }

        return redirect('login')->with('error', 'Oppes! You have entered invalid credentials');
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('login');
    }

}
