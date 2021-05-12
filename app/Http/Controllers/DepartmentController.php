<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
    public function create(){
        $department = new Department();
        $department = $department->all();
        return view('admin.createDepartment',['departments'=>$department]);
    }
    public function store(Request $request){
        $request->validate([
            'department' => ['required'],
            'level' => ['required'],
        ]);
        $department = new Department();
        $department->create([
            'department' => $request->department,
            'level' => $request->level
        ]);
        return back()->with('success', $request->department.' added successfully');
    }

}
