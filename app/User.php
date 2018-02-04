<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use \Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verification_token', 'department_id', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles(){
        return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
    }

    public function hasAnyRole($roles){
        if (is_array($roles)){
            foreach ($roles as $role) {
                if ($this->hasRole($role)){
                    return true;
                } 
            }
        } else {
            if ($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }

    public function hasRole($role){
        if ($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;    
    }

    public function isRoles($role){
        return $this->whereHas('roles', function($q) use($role){
            $q->whereName($role);
        });
    }

    public function isNotRoles($role){
        return $this->whereHas('roles', function($q) use($role){
            $q->where('name', '!=', $role);
        });
    }    

    public function scopeNotSuper($q){
        return $q->whereHas('roles', function($q){
            $q->where('name', '=', 'user');
        });
    }

    public function getCreatedAtAttribute($v){
        if($v){
            return Carbon::parse($v)->format('d-m-Y');
        }
    }

    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function order(){
        return $this->hasMany('App\Order');
    }
}
