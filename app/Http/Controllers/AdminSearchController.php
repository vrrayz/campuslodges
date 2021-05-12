<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminSearchController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);

    }

    public function index(Request $request){
        $users = User::where('username','=',$request->search_item)
            ->orWhere('first_name','=',$request->search_item)
            ->orWhere('last_name','=',$request->search_item)
            ->orWhere('email','=',$request->search_item)->paginate(10);

        return view('admin.user.searchResult',['users'=>$users,'result'=>$request->search_item]);
    }
}
