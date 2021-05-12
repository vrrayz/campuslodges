<?php

namespace App\Http\Controllers;

use App\Lodge;
use Illuminate\Http\Request;

class AgentHouseStatusController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index($approval_status){
        $lodge = new Lodge();
        switch ($approval_status){
            case 'denied':
                $lodge = $lodge->where([['approval_status','denied'],['availability','!=','expired'],['user_id', auth()->user()->id]])->paginate(12);
                break;
            case 'approved':
                $lodge = $lodge->where([['approval_status','approved'],['availability','!=','expired'],['user_id', auth()->user()->id]])->paginate(12);
                break;
            case 'pending':
                $lodge = $lodge->where([['approval_status','pending'],['availability','!=','expired'],['user_id', auth()->user()->id]])->paginate(12);
                break;
            case 'expired':
                $lodge = $lodge->where([['availability','expired'],['user_id', auth()->user()->id]])->paginate(12);
                break;
            default:
                return redirect('/agent/houses');
        }
        return view('agent.house.index',['lodges'=>$lodge]);
    }
    public function pushOnline(Lodge $lodge){
        if ($lodge->user->id == auth()->user()->id){
            $lodge->availability = 'available';
            $lodge->update();
            return back()->with('update_success','Lodge Successfully Published');
        }
        return back();
    }
    public function pull(Lodge $lodge){
        if ($lodge->user->id == auth()->user()->id){
            $lodge->availability = 'unavailable';
            $lodge->update();
            return back()->with('update_success','Lodge Successfully Pulled Down');
        }
        return back();
    }
}
