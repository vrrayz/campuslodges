<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\User;
use Illuminate\Http\Request;

class AdminAgentVerificationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function edit(User $agent_id)
    {
        return view('admin.agent.verification', ['agent' => $agent_id]);
    }

    public function store(Request $request, User $agent_id)
    {
        $request->validate([
            'action' => 'required|string',
            'reason' => 'required|string'
        ]);
        $msg = '';
        Notifications::create([
            'user_id' => $agent_id->id,
            'requested_from' => auth()->user()->id,
            'notification_type' => 'admin_response_agent_verification',
            'message' => $request->reason,
            'status' => 'unread'
        ]);
        if ($request->action == 'rejected') {
            $msg = 'Rejection Message Successful';
        }else{
            $agent_id->kyc->is_validated = 1;
            $agent_id->kyc->update();
            $msg = 'Verification Successful';
        }
        return back()->with('form_success', $msg);
//        dd($request->all());
    }
}
