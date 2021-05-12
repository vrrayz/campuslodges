<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminAgentApplicationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function show($user_id){
        return redirect('/admin/user/'.$user_id);
    }
    public function update(User $user_id){
        $user_id->is_agent = 1;
        $user_id->update();
        return back()->with('update_success','User is now an agent');
    }
}
