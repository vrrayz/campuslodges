<?php

namespace App\Http\Controllers;

use App\Lodge;
use Illuminate\Http\Request;

class LodgeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified'])->except(['index']);
    }
    public function index(Request $request){
//        dd($request->all());
        $lodges = new Lodge();
        $min_price = $max_price = 0;
        if (isset($request->vicinity))
            $lodges = $lodges->where('vicinity',$request->vicinity);
        if (isset($request->location))
            $lodges = $lodges->where('location',$request->location);
        if (isset($request->lodge_type))
            $lodges = $lodges->where('type', $request->lodge_type);
        if (isset($request->min_price)){
            $min_price = intval(str_replace(',','',$request->min_price));
            $lodges = $lodges->where('price','>=', $min_price);
        }
        if (isset($request->max_price)){
            $max_price = intval(str_replace(',','',$request->max_price));
            $lodges = $lodges->where('price', '<=', $max_price);
        } 
        $lodges = $lodges->where([
            ['availability','available'],
            ['approval_status','approved'],
            ]);
        $lodges = $lodges->get();
        // dd($lodges);
        return view('lodge.index',['lodges'=>$lodges,'min_price'=> $min_price, 'max_price' => $max_price]);

//        if (isset($request->))
    }
    public function show(Lodge $lodge){
        $lodge->view_count += 1;
        $lodge->update();
        return view('lodge.show',['lodge'=>$lodge]);
    }
}
