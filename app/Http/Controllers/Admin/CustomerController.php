<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Customer;
class CustomerController extends Controller
{
    private $customer;

    public function __construct(Customer $customer) {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->customer->get();
        return view('admin.modules.customer.index',\compact('customers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->customer->find($id)->delete();
             return response()->json([
                 'code' => 200,
                 'message' => 'success'
             ]);
         } catch (\Exception $exception) {
             Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());
 
             return response()->json([
                 'code' => 500,
                 'message' => 'fail'
             ]);
         }
    }
}
