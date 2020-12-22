<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
class RoleController extends Controller
{
    private $role;
    private $permissions;

    public function __construct(Role $role,Permission $permissions) {
        $this->role = $role;
        $this->permissions = $permissions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->all();
        return view('admin.modules.role.index',\compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permissions->where('parent_id',0)->get();
        return view('admin.modules.role.create',\compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = $this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        $role->permissions()->attach($request->permission_id);
        return \redirect()->route('admin.role.index');


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
        $role = $this->role->find($id);
        $permissions = $this->permissions->where('parent_id',0)->get();
        $permissionsChecked = $role->permissions;
        return view('admin.modules.role.edit',\compact('role','permissions','permissionsChecked'));
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
        $role = $this->role->find($id);
         $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
      
        $role->permissions()->sync($request->permission_id);
        return \redirect()->route('admin.role.index');


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
            $this->role->find($id)->delete();
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
