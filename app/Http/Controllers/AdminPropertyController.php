<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\Property;
use Illuminate\Http\Request;

class AdminPropertyController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $property = Property::paginate(10);
        return view('admin.property.index',['properties'=>$property]);
    }
    public function show(Property $property){
        return view('admin.property.show',['property'=>$property]);
    }
    public function verification(Request $request, Property $property){
//        dd($request->all());
        $request->validate([
            'action' => 'required|string',
            'reason' => 'required|string'
        ]);
        $msg = '';
        Notifications::create([
            'user_id' => $property->user->id,
            'property_id' => $property->id,
            'requested_from' => auth()->user()->id,
            'notification_type' => 'admin_response_property_verification',
            'message' => $request->reason,
            'status' => 'unread'
        ]);
        if ($request->action == 'rejected') {
            $msg = 'Rejection Message Successful';
            $property->approval_status = 'denied';
            $property->availability = 'unavailable';
        }else{
            $property->approval_status = 'approved';
            $property->availability = 'available';
            $msg = 'Verification Successful';
        }
        $property->update();
        return back()->with('form_success', $msg);
    }
}
