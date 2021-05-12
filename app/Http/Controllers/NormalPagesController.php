<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NormalPagesController extends Controller
{
    //
    public function contact(){
        return view('contact');
    }
    public function agent(){
        return view('agent');
    }
    public function about(){
        return view('about');
    }
}
