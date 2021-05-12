<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function create(){
        return view('admin.user.create');
    }
    public function store(Request $request){
        $request->validate([
            'first_name' => ['required', 'string','min:3', 'max:255'],
            'last_name' => ['required', 'string','min:3', 'max:255'],
            'state_of_origin' => ['required', 'string','min:3', 'max:60'],
            'L_G_A' => ['required', 'string','min:3', 'max:255'],
            'hometown' => ['required', 'string','min:3', 'max:255'],
            'username' => ['required', 'string','min:3', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_no' => ['required', 'string','min:11', 'max:11', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'student' => ['required'],
        ]);
        if ($request->student == 'yes'){
            $request->validate([
                'department' => ['required', 'string','min:3', 'max:255'],
                'reg_no' => ['required', 'string','min:3', 'max:255'],
                'level' => ['required', 'numeric','min:100', 'max:900'],
                'programme' => ['required', 'string','min:3', 'max:255'],
            ]);
        }
        $user = new User();
        $user = $user->create([
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'phone_no' => $request->phone_no,
            'password' => Hash::make($request->password),
            'state_of_origin' => $request->state_of_origin,
            'lga_of_origin' => $request->L_G_A,
            'hometown' => $request->hometown,
        ]);
        if ($request->student == 'yes'){
            $user->update([
                'is_student' => 1,
                'department' => $request->department,
                'reg_no' =>  $request->reg_no,
                'level' =>  $request->level,
                'programme' => $request->programme,
            ]);
        }elseif ($request->student == 'no'){
            $user->update([
                'is_student' => 0,
            ]);
        }
        $user->kyc()->create([
            'means_of_id' => '',
            'id_number' => '',
            'id_photo' => '',
            'residential_address' => '',
            'is_validated' => false,
        ]);
        return redirect('/admin/user/'.$user->id);
    }

    public function show(User $user){
        return view('admin.user.index',['user'=>$user]);
    }
    public function edit(User $user){
        return view('admin.user.edit',['user'=>$user]);
    }
    public function update(Request $request, User $user){
        $request->validate([
            'name' => ['required', 'string','min:3', 'max:255'],
            'state_of_origin' => ['required', 'string','min:3', 'max:60'],
            'L_G_A' => ['required', 'string','min:3', 'max:255'],
            'hometown' => ['required', 'string','min:3', 'max:255'],
            'username' => ['required', 'string','min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_no' => ['required', 'string','min:11', 'max:11'],
            'student' => ['required'],
        ]);
        if ($request->student == 'yes'){
            $request->validate([
                'department' => ['required', 'string','min:3', 'max:255'],
                'reg_no' => ['required', 'string','min:3', 'max:255'],
                'level' => ['required', 'numeric','min:100', 'max:900'],
                'programme' => ['required', 'string','min:3', 'max:255'],
            ]);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone_no' => $request->phone_no,
            'state_of_origin' => $request->state_of_origin,
            'lga_of_origin' => $request->L_G_A,
            'hometown' => $request->hometown,
        ]);
        if ($request->student == 'yes'){
            $user->update([
                'is_student' => 1,
                'department' => $request->department,
                'reg_no' =>  $request->reg_no,
                'level' =>  $request->level,
                'programme' => $request->programme,
            ]);
        }elseif ($request->student == 'no'){
            $user->update([
                'is_student' => 0,
            ]);
        }
        return redirect('/admin/user/'.$user->id)->with('update_success','Update Successful');
    }
}
