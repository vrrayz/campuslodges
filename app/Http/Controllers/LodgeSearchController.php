<?php

namespace App\Http\Controllers;

use App\Lodge;
use Illuminate\Http\Request;

class LodgeSearchController extends Controller
{
    //
    public function showLodge($vicinity){
        $lodge = new Lodge();
        $lodge = $lodge->where('vicinity',$vicinity)->get();
        return json_encode($lodge);
    }
}
