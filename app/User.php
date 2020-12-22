<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles() {
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
    }

    public function checkPermissionAccess($permissionCheck) {
        //use login use co quyen add,sua danh muc va xem menu
        // B1 lay tat ca cac quen cua user dang nhap vao he thong
              //B2 so sanh gia tri dua vao cac route hien tai xem co ton tai trong cac quyen ma minh lay dc hay khong 

        $roles = auth()->user()->roles;
      
        foreach($roles as $role) {
            $permissions = $role->permissions;
            if($permissions->contains('key_code',$permissionCheck)) {
                return true;
            } 
        }

        return false;
    
    }
}
