<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Contact;
use Session;
use Illuminate\Support\Facades\Auth;
use Validator;
class CustomerController extends Controller
{
    private $customer;
    private $contact;

    public function __construct(Customer $customer,Contact $contact) {
        $this->customer = $customer;
        $this->contact = $contact;
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


    public function addContact(Request $request) {
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'content' => 'required',
        ]);


        if ($validator->passes()) {

            $this->contact->create([
                'name' =>$request->name,
                'email' =>$request->email,
                'subject' =>$request->subject,
                'content' =>$request->content
           ]);
			return response()->json(['success'=>'Added new records.']);
        }
    

    	return response()->json(['error'=>$validator->errors()->all()]);
    }
}
