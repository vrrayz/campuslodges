<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\User;
use Illuminate\Http\Request;

class AgentProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    //
    public function store(Request $request)
    {
//        dd($request->all());
        switch ($request->occupation) {
            case 'student':
                $request->validate([
                    'programme' => ['required', 'string', 'min:3', 'max:255'],
                    'department' => ['required', 'string', 'min:3', 'max:255'],
                    'level' => ['required', 'string', 'min:3', 'max:50'],
                    'reg_no' => ['required', 'string', 'min:3', 'max:50'],
                ]);
                break;
            case 'non_student':
                $request->validate([
                    'occupation_description' => ['required', 'string', 'min:3', 'max:255'],
                    'means_of_id' => ['required', 'string', 'min:3', 'max:255'],
                    'id_number' => ['required', 'string', 'min:3', 'max:255'],

                ]);
                break;
        }
//        if (auth()->user()->kyc->id_photo == '' || auth()->user()->kyc->id_photo == null){
//            $request->validate([
//                'id_card' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            ]);
//            $name = $request->id_card->getClientOriginalName();
//            $request->id_card->move(public_path() . '/agents_id/', $name);
//            auth()->user()->kyc->id_photo = $name;
//            auth()->user()->kyc->update();
//            $user = new User();
//            $admin = $user->where('is_admin','=',1)->get();
//            foreach ($admin as $a){
//                Notifications::create([
//                    'user_id' => $a->id,
//                    'requested_from' => auth()->user()->id,
//                    'notification_type' => 'agent_pending_verification',
//                    'message' => auth()->user()->username.' just uploaded account verification details',
//                    'link'=> '/admin/agent/'.auth()->user()->id.'/verification',
//                    'status' => 'unread'
//                ]);
//            }
//        }
//        auth()->user()->first_name = $request->first_name;
//        auth()->user()->last_name = $request->last_name;
//        auth()->user()->phone_no = $request->phone_number;
//        auth()->user()->state_of_origin = $request->state_of_origin;
//        auth()->user()->lga_of_origin = $request->lga_of_origin;
//        auth()->user()->hometown = $request->hometown;
//        auth()->user()->kyc->residential_address = $request->residential_address;
        if ($request->occupation == 'student') {
            auth()->user()->is_student = 1;
            auth()->user()->programme = $request->programme;
            auth()->user()->department = $request->department;
            auth()->user()->level = $request->level;
            auth()->user()->reg_no = $request->reg_no;
        } elseif ($request->occupation == 'non_student') {
            auth()->user()->is_student = 0;
            auth()->user()->occupation_description = $request->occupation_description;
            auth()->user()->kyc->means_of_id = $request->means_of_id;
            auth()->user()->kyc->id_number = $request->id_number;
        }
        auth()->user()->update();
        auth()->user()->kyc->update();
        return redirect('/user/account/index')->with('update_success','Verification details updated');
    }
}
