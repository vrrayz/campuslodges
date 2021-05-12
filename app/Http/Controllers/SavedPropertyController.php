<?php

namespace App\Http\Controllers;

use App\Property;
use App\SavedProperty;
use Illuminate\Http\Request;

class SavedPropertyController extends Controller
{
    //
    public function index(){
        $savedProperties = auth()->user()->savedProperty()->paginate(15);
        return view('user.saved_properties.index',['savedProperties'=>$savedProperties]);
    }
    public function store(Property $property)
    {

        $savedProperty = SavedProperty::where([
            ['property_id', $property->id],
            ['user_id', auth()->user()->id]
        ]);
        if (count($savedProperty->get()) == 0){
            auth()->user()->savedProperty()->create([
                'property_id' => $property->id,
            ]);
        }elseif(count($savedProperty->get()) == 1){
            $savedProperty->delete();
        }
        return response()->json(['message' => count($savedProperty->get())]);
    }
}
