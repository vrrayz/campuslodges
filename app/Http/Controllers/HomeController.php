<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.account.index');
    }
    public function edit(){
        return view('user.account.edit');
    }
    public function update(Request $request){
        $request->validate([
            'first_name' => ['required', 'string','min:3', 'max:255'],
            'last_name' => ['required', 'string','min:3', 'max:255'],
            'phone_no' => ['required', 'string','min:11', 'max:11'],
            'gender' => ['required', 'string', 'min:3'],
        ]);
        $phone_exist = User::where([
            ['phone_no',$request->phone_no],
            ['id','<>',auth()->user()->id],
        ])->get();
        if (count($phone_exist) > 0){
            return back()->with('phone_error','This phone number already exist');
        }
        auth()->user()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_no' => $request->phone_no,
            'gender' => $request->gender,
        ]);
        return redirect('/user/account/index')->with('update_success','Profile updated successfully');
    }
    public function apply(){
        $user = new User();
        $admin = $user->where('is_admin','=',1)->get();
        // dd(auth()->user()->profilePicture->picture_name);
        if(auth()->user()->profilePicture->picture_name == "" || auth()->user()->profilePicture->picture_name == null){
            return back()->with('v_agent_error','You have to upload a profile picture first');
        }
        foreach ($admin as $a){
            Notifications::create([
                'user_id' => $a->id,
                'requested_from' => auth()->user()->id,
                'notification_type' => 'agent_application',
                'message' => auth()->user()->username.' made a request to be an agent',
                'link'=> '/admin/agent/'.auth()->user()->id.'/agent_application',
                'status' => 'unread'
            ]);
        }
        return back()->with('update_success','Your application request has been sent');
//        dd("Get");
    }
}
