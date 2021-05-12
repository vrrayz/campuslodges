<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserPasswordController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function edit(){
        return view('user.account.changepass');
    }
    public function update(Request $request){
        $request->validate([
           'current_password' => 'required|string|min:8|max:15',
           'password' => 'required|string|min:8|max:15|confirmed',
        ]);
        $what = Hash::check($request->current_password,auth()->user()->password);
        if (!$what)
            return back()->with('wrong_password','Incorrect current password');
        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect('/user/account/index')->with('update_success','Password Updated Successfully');
//        return view('user.account.changepass');
    }
}
