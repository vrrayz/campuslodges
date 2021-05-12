<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;

class PropertiesPublishController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function pushOnline(Property $property){
        if ($property->user->id == auth()->user()->id){
            $property->availability = 'available';
            $property->update();
            return back()->with('update_success','Property Successfully Published');
        }
        return back();
    }
    public function pull(Property $property){
        if ($property->user->id == auth()->user()->id){
            $property->availability = 'unavailable';
            $property->update();
            return back()->with('update_success','Property Successfully Pulled Down');
        }
        return back();
    }
}
