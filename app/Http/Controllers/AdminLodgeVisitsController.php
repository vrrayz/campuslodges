<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\User;
use Illuminate\Http\Request;

class AdminLodgeVisitsController extends Controller
{
    //
    public function __construct()
    {
        $this>$this->middleware(['auth','verified']);
    }
    public function show(Notifications $notification){
        $lodge = $notification->lodge;
        $lodge_title = $lodge->location.' at '.$notification->lodge->type;
        $lodge_agent = $lodge->user->username;
        $lodge_agent_id = $lodge->user->id;
        $lodge_picture = $lodge->lodgePicture->first()->lodge_pic;

        $user = User::find($notification->requested_from);
        return view('admin.lodge_visits.show',[
            'visit_request' => $notification,
            'lodge_picture' => $lodge_picture,
            'lodge_title' => $lodge_title,
            'lodge_agent' => $lodge_agent,
            'lodge_agent_id' => $lodge_agent_id,
            'username' => $user->username,
            'user_id' => $user->id,
        ]);
    }
}
