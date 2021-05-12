<?php

namespace App\Http\Controllers;

use App\LodgeSpot;
use Illuminate\Http\Request;

class LodgeSpotController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin')->except(['getLodgeSpot']);
    }

    public function index(){
        $lodge = new LodgeSpot();
        $lodge = $lodge->paginate(5);
        return view('admin.lodgespot.index',['lodgeSpots'=>$lodge]);
    }
    public function store(Request $request){
        $request->validate([
            'vicinity' => ['required'],
            'location' => ['required'],
        ]);
        $lodge_spot = new LodgeSpot();
        $lodge_spot->create([
            'vicinity' => $request->vicinity,
            'location' => $request->location
        ]);
        return back()->with('success', $request->location.' added successfully');
    }
    public function destroy(LodgeSpot $lodgeSpot){
//        dd("We have arrived");
        $lodgeSpot->delete();
        return back()->with('success','Lodge Deleted Successfully');
    }
    public function getLodgeSpot($vicinity){
        $lodgeSpot = new LodgeSpot();
        $lodgeSpot = $lodgeSpot->where('vicinity',$vicinity)->get();
        return json_encode($lodgeSpot);
    }
}
