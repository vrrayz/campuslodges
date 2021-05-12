<?php

namespace App\Http\Controllers;

use App\Lodge;
use App\LodgeSpot;
use App\Property;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(){
        $lodgeSpots = LodgeSpot::all();
        $lodges = Lodge::where('availability','available')->get();
        $properties = Property::where('availability','available')->get();
        return view('index',['lodges'=>$lodges,'properties'=>$properties,'lodgeSpots'=>$lodgeSpots]);
    }
}
