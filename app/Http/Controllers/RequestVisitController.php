<?php

namespace App\Http\Controllers;

use App\Lodge;
use App\Notifications;
use App\User;
use Illuminate\Http\Request;

class RequestVisitController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function sendRequest(Lodge $lodge){
        $admin = User::where('is_admin', '=', 1)->get();
        foreach ($admin as $a) {
            $notification = Notifications::create([
                'user_id' => $a->id,
                'lodge_id' => $lodge->id,
                'requested_from' => auth()->user()->id,
                'notification_type' => 'user_request_visit',
                'message' => auth()->user()->username . ' just made a request to visit a lodge',
                'link' => '/admin/requests/lodge_visits/',//Link id to navigate the request
                'status' => 'unread'
            ]);
            $notification->update([
                'link' => '/admin/requests/lodge_visits/'.$notification->id,//Link id to navigate the request
            ]);
        }
        return response()->json(['message' => $admin]);
    }
}
