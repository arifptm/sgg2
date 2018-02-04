<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;
use App\Department;

use App\Http\Requests\admin\UserCreateRequest;
use App\Http\Requests\admin\UserEditRequest;


class UserController extends Controller
{
    public function index(){
        $roles = Role::where('name', '!=', 'super')->orderBy('name', 'asc')->get();
        $departments = Department::orderBy('name', 'asc')->get();        
    	return view('admin.user.index',['roles'=>$roles, 'departments'=>$departments]);
    }

    public function list(){
    	$users = User::orderBy('id', 'desc')->where('id','!=', 1)->paginate(20);
    	return view('admin.user.list',['users'=>$users]);        
    }    

    public function store(UserCreateRequest $request){   
        
    	$user = new User();
    	$user->name = $request->name;
    	$user->email = $request->email;
        $user->verification_token = base64_encode($request->email);
        $user->department_id = $request->department_id;
    	$user->password = bcrypt($request->password);
        $user->verified = $request->verified;
        
    	$user->save(); 

        foreach ($request->roles as $role){
            $user->roles()->attach(Role::whereId($role)->first());
        }
    	
    	return response()->json(['user'=>$user]);
    }

    public function update(UserEditRequest $request){
		$user = User::findOrFail($request->id);
		$user->name = $request->name;
        $user->email = $request->email;  
        
        $user->department_id = $request->department_id;
        
        $user->verified = (isset($request->verified)) ? 1 : 0;

        $user->password = (isset($request->password)) ? bcrypt($request->password) : '' ;

		$user->save();        

        foreach(Role::all() as $role){
            $user->roles()->detach($role);
        }
        foreach ($request->roles as $role){
            $user->roles()->attach(Role::whereId($role)->first());
        }

    	return response()->json(['user'=>$user]);
    }


    public function destroy(Request $request){
    	$user = User::destroy($request->id);
    	return response()->json(['user' => $user]);
    }
}