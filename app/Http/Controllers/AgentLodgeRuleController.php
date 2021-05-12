<?php

namespace App\Http\Controllers;

use App\LodgeRule;
use Illuminate\Http\Request;

class AgentLodgeRuleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function update(LodgeRule $rule, $value){
        if ($rule->lodge->user->id == auth()->user()->id){
            $rule->rule = $value;
            $rule->update();
            return response()->json(['message'=>$value]);
        }

    }
}
