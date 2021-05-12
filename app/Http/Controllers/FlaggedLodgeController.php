<?php

namespace App\Http\Controllers;

use App\FlaggedLodge;
use App\Lodge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlaggedLodgeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function store(Request $request,Lodge $lodge){
        $validator = Validator::make($request->all(),[
            'reason' => 'required|string|max:255'
        ]);
        $flaggedLodge = FlaggedLodge::where([
            ['lodge_id', $lodge->id],
            ['user_id', auth()->user()->id]
        ]);
        if (count($flaggedLodge->get()) == 0){
            if ($validator->fails()){
                return response()->json(['error'=>$validator->errors()->all()]);
            }
            auth()->user()->flaggedLodge()->create([
                'lodge_id' => $lodge->id,
                'reason' => $request->reason,
            ]);
        }elseif(count($flaggedLodge->get()) == 1){
            $flaggedLodge->delete();
        }
        return response()->json(['message' => $request->reason]);
    }
}
