<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePictureController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function edit(){
        return view('user.picture.edit');
    }
    public function update(Request $request){
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $name = $request->profile_picture->getClientOriginalName();
//        $request->file('profile_picture')->storeAs('public/profile',$name);
        $request->profile_picture->move(public_path() . '/profile/', $name);
        auth()->user()->profilePicture->picture_name = $name;
        auth()->user()->profilePicture->update();
//        dd($request->all());
        return redirect('/user/account/index')->with('update_success','Profile Picture Updated Successfully');
    }
}
