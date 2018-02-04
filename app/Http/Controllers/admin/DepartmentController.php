<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Department;
use App\Http\Requests\admin\DepartmentCreateRequest;

class DepartmentController extends Controller
{
    public function index(){        
    	return view('admin.department.index');
    }

    public function list(){
        $departments = Department::orderBy('name', 'asc')->get();
        return view('admin.department.list', ['departments'=>$departments]);
    }

    public function store(DepartmentCreateRequest $request){ 
    	$department = Department::create($request->all());
        return response()->json(['department'=>$department]);
    }

    public function update(Request $request){
		$department = Department::findOrFail($request->id);
		$department->name = $request->name;
		$department->save();
		return response()->json(['department'=>$department]);
    }

    public function destroy(Request $request){
    	$department = Department::destroy($request->department_id);
    	return response()->json(['department' => $department]);
    }
}

 