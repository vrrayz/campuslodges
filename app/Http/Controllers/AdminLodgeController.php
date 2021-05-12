<?php

namespace App\Http\Controllers;
use App\Lodge;
use App\Notifications;
use Illuminate\Http\Request;

class AdminLodgeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $lodge = Lodge::paginate(10);
        return view('admin.lodge.index',['lodges'=>$lodge]);
    }
    public function show(Lodge $lodge){
        $notification = Notifications::where([
            ['requested_from',$lodge->user->id],
            ['lodge_id',$lodge->id],
            ['notification_type','house_pending_verification'],
        ])->orderBy('created_at', 'desc')->get();
        foreach ($notification as $n){
            $n->status = 'read';
            $n->update();
        }
        return view('admin.lodge.show',['lodge'=>$lodge]);
    }

    public function verification(Request $request, Lodge $lodge){
//        dd($request->all());
        $request->validate([
            'action' => 'required|string',
            'reason' => 'required|string'
        ]);
        $msg = '';
        Notifications::create([
            'user_id' => $lodge->user->id,
            'lodge_id' => $lodge->id,
            'requested_from' => auth()->user()->id,
            'notification_type' => 'admin_response_lodge_verification',
            'message' => $request->reason,
            'status' => 'unread'
        ]);
        if ($request->action == 'rejected') {
            $msg = 'Rejection Message Successful';
            $lodge->approval_status = 'denied';
        }else{
            $lodge->approval_status = 'approved';
            $lodge->availability = 'available';
            $msg = 'Verification Successful';
        }
        $lodge->update();
        return back()->with('form_success', $msg);
    }
}
