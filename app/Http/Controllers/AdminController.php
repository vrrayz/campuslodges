<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(){
        $user = new User();
        $users = $user->paginate(2);
        return view('admin.index',['users'=>$users]);
    }
}
