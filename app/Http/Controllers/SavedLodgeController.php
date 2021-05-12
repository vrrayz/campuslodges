<?php

namespace App\Http\Controllers;

use App\Lodge;
use App\SavedLodge;
use Illuminate\Http\Request;

class SavedLodgeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(){
        $savedLodges = auth()->user()->savedLodge;
        return view('user.saved_lodges.index',['savedLodges'=>$savedLodges]);
    }

    public function store(Lodge $lodge)
    {

        $savedLodge = SavedLodge::where([
            ['lodge_id', $lodge->id],
            ['user_id', auth()->user()->id]
        ]);
        if (count($savedLodge->get()) == 0){
            auth()->user()->savedLodge()->create([
                'lodge_id' => $lodge->id
            ]);
        }elseif(count($savedLodge->get()) == 1){
            $savedLodge->delete();
        }
        return response()->json(['message' => count($savedLodge->get())]);
    }
}
