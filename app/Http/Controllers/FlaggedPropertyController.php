<?php

namespace App\Http\Controllers;

use App\FlaggedProperty;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlaggedPropertyController extends Controller
{
    //
    public function store(Request $request, Property $property){
        $validator = Validator::make($request->all(),[
            'reason' => 'required|string|max:255'
        ]);
        $flaggedProperty = FlaggedProperty::where([
            ['property_id', $property->id],
            ['user_id', auth()->user()->id]
        ]);
        if (count($flaggedProperty->get()) == 0){
            if ($validator->fails()){
                return response()->json(['error'=>$validator->errors()->all()]);
            }
            auth()->user()->flaggedProperty()->create([
                'property_id' => $property->id,
                'reason' => $request->reason,
            ]);
        }elseif(count($flaggedProperty->get()) == 1){
            $flaggedProperty->delete();
        }
        return response()->json(['message' => $request->reason]);
    }
}
