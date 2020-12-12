<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use  App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->all();
        return view('admin.modules.user.index',\compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            're_password'=>'required|same:password',
            'email'=>'required|email'
        ]);

        $data = $request->except('_token','re_password');
        $file = $request->file('image');
        $data['password'] = bcrypt($request->password);
        $data['created_at'] = new DateTime;

        if ($file) {
            $name = $file->getClientOriginalName();
            $image = Str::random(4)."_".$name;
            while(file_exists("public/uploads/users/".$image)) {
                $image = Str::random(4)."_".$name;
            }
            $file->move('public/uploads/users/',$image);
            $data['image'] = $image;
        }else{
            $data['image'] = '';
        }
        $this->user->insert($data);
        return redirect()->route('admin.user.index')->with('message','Insertd User SuccessFully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
        return view('admin.modules.user.edit',\compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $hinh = $this->user->find($id);
        $data = $request->except('_token','re_password','changePassword');
        $file = $request->file('image');
        $data['updated_at'] = new DateTime;
        if($request->changePassword=="on") {
            $validatedData = $request->validate([
                'password'=>'required|max:8',
                're_password'=>'required|same:password'        
                ]);
            $data['password'] = Bcrypt($request->password);
        }
        if ($file) {
            $name = $file->getClientOriginalName();
            $image = Str::random(4)."_".$name;
            while(file_exists("public/uploads/users/".$image)) {
                $image = Str::random(4)."_".$name;
            }
            $file->move('public/uploads/users/',$image);
            unlink("public/uploads/users/".$hinh->image);
            $data['image'] = $image;
        }
        $this->user->where('id',$id)->update($data);
        return redirect()->route('admin.user.index')->with('message','Updated User SuccessFully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->where('id',$id)->delete();
        return redirect()->route('admin.user.index');
    }

    public function login() {
        return view('admin.login');
    }

    public function progressLogin(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with('message','Email Or Password Wrong');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
