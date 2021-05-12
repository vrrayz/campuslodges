<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    //
    public function index(){
        $properties = Property::where([
            ['approval_status','approved'],
            ['availability','available']
        ])->paginate(15);
        return view('properties.index',['properties'=>$properties]);
    }
    public function show(Property $property)
    {
        if ($property->availability == 'available' && $property->approval_status == 'approved') {
            $property->view_count += 1;
            $property->update();
            return view('properties.show', ['property' => $property]);
        }
        return redirect('/props');
    }
}
