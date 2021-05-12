<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgentKycController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);

    }

    public function index()
    {
        $verification_notifications = auth()->user()->notification()->where([
            ['notification_type', '=', 'admin_response_agent_verification'],
        ])->orderBy('created_at','desc')->get();
        foreach ($verification_notifications as $notification){
            $notification->status = 'read';
            $notification->update();
        }
        return view('agent.kyc',['verification_notifications'=>$verification_notifications]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_card' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $name = $request->id_card->getClientOriginalName();
        $request->id_card->move(public_path() . '/agents_id/', $name);
        auth()->user()->kyc->id_photo = $name;
        auth()->user()->kyc->update();
//        dd($request->all());
        $user = new User();
        $admin = $user->where('is_admin','=',1)->get();
        foreach ($admin as $a){
            Notifications::create([
                'user_id' => $a->id,
                'requested_from' => auth()->user()->id,
                'notification_type' => 'agent_pending_verification',
                'message' => auth()->user()->username.' just uploaded account verification details',
                'link'=> '/admin/agent/'.auth()->user()->id.'/verification',
                'status' => 'unread'
            ]);
        }
        return back()->with('upload_success', 'Upload Successful');
    }
}
