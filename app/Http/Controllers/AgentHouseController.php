<?php

namespace App\Http\Controllers;

use App\Department;
use App\Lodge;
use App\Notifications;
use App\User;
use Illuminate\Http\Request;

class AgentHouseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    //
    public function index()
    {
        $department = new Department();
        $department = $department->all();
        return view('agent.uploadLodge', ['departments' => $department]);
    }

    public function getLevel($department)
    {
        $dep = new Department();
        $dep = $dep->where('department', '=', $department)->get();
        return json_encode($dep);
    }
    public function renew(Lodge $lodge){
        if ($lodge->user->id == auth()->user()->id){
            $p_time = time();
            $e_time = 0;
            if ($lodge->vicinity == 'on'){
                $e_time += $p_time + (3600 * 24 * 3);//Set the expiry time of the lodge for on campus
            }elseif ($lodge->vicinity == 'off'){
                $e_time += $p_time + (3600 * 24 * 7);//Set the expiry time of the lodge for off campus
            }
            if ($lodge->approval_status != 'approved'){
                $lodge->update([
                    'availability' => 'unavailable',
                ]);
            }else{
                $lodge->update([
                    'availability' => 'available',
                ]);
            }
            $lodge->update([
                'posted_time' => $p_time,
                'expiry_time' => $e_time,
            ]);
            return back()->with('success','Lodge Successfully Renewed');
        }
        return back();
    }
    public function show()
    {
        $lodges = auth()->user()->lodge;
        return view('agent.houses', ['lodges' => $lodges]);
    }

    public function showHouse($lodge_id)
    {
        $lodge = auth()->user()->lodge->find($lodge_id);
        $department = new Department();
        $department = $department->all();
        $verification_notifications = auth()->user()->notification()->where([
            ['notification_type', '=', 'admin_response_lodge_verification'],
            ['lodge_id', '=', $lodge_id],
        ])->orderBy('created_at', 'desc')->get();
        foreach ($verification_notifications as $notification) {
            $notification->status = 'read';
            $notification->update();
        }
        return view('agent.house', ['lodge' => $lodge, 'departments' => $department, 'verification_notifications' => $verification_notifications]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => ['required', 'min:3', 'max:30', 'string',],
            'lodge_type' => ['required', 'min:2', 'max:50', 'string',],
            'who_can_rent' => ['required', 'min:3', 'max:30', 'string',],
            'description' => ['required', 'min:3', 'max:255', 'string',],
            'vicinity' => ['required', 'string',],
            'lodge_rules' => ['required', 'string',],
            'price' => ['required', 'min:3', 'max:16', 'string',],
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if (count($request->file('filename')) < 3 || count($request->file('filename')) > 10) {
            return back()->with('picture_amount', 'Pictures upload minimum is 5 and Pictures upload maximum is 10');
        } else {
            if ($request->who_can_rent != 'Jupeb'){
                $request->validate([
                    'department' => ['required', 'min:3', 'max:30', 'string',],
                    'level' => ['required', 'min:3', 'max:30', 'string'],
                ]);
            }
            if ($request->lodge_rules == 'yes') {
//                dd($request->all());
                $request->validate([
                    'rules' => ['required'],
                    'rules.*' => ['string'],
                ]);
            }
            $lodge = new Lodge();
            $price = intval(str_replace(',', '', $request->price));
            $lodge = $lodge->create([
                'user_id' => auth()->user()->id,
                'location' => $request->location,
                'type' => $request->lodge_type,
                'who_can_rent' => $request->who_can_rent,
                'description' => $request->description,
                'vicinity' => $request->vicinity,
                'price' => $price,
                'approval_status' => 'pending',
                'view_count' => 0,
                'posted_time' => 0,
                'expiry_time' => 0,
            ]);
            if ($request->who_can_rent != 'Jupeb'){
                $lodge->update([
                    'department' => $request->department,
                    'level' => $request->level,
                ]);
            }else{
                $lodge->update([
                    'department' => 'Unavailable',
                    'level' => 'Unavailable',
                ]);
            }
            $p_time = time();
            $e_time = 0;
            if ($request->vicinity == 'on'){
                $e_time += $p_time + (3600 * 24 * 3);//Set the expiry time of the lodge for on campus
            }elseif ($request->vicinity == 'off'){
                $e_time += $p_time + (3600 * 24 * 7);//Set the expiry time of the lodge for off campus
            }
            $lodge->update([
                'posted_time' => $p_time,
                'expiry_time' => $e_time,
            ]);
            if ($request->lodge_rules == 'yes') {
                foreach ($request->rules as $rules => $value) {
                    $lodge->lodgeRule()->create([
                        'rule' => $value,
                    ]);
                }
            }
            if ($request->hasfile('filename')) {
                $count = 0;
                foreach ($request->file('filename') as $image) {
                    // $name = $image->getClientOriginalName();
                    $image_name = time() . ".jpg"; //New Image Name
                    //Location Of The Upload This is meant for offline testing
                    //Change public to public_html when online
                    $picture_location = '../public_html/house_images/' . $image_name;
                    $image_info = getimagesize($image);
                    if ($image_info['mime'] == 'image/jpeg')
                        $image = imagecreatefromjpeg($image);

                    elseif ($image_info['mime'] == 'image/gif')
                        $image = imagecreatefromgif($image);

                    elseif ($image_info['mime'] == 'image/png')
                        $image = imagecreatefrompng($image);

                    $upload_image = imagejpeg($image, $picture_location, 20);
                    // $image->move(public_path() . '/house_images/', $name);
                    $lodge->lodgePicture()->create([
                        'lodge_pic' => $image_name,
                    ]);
                    $count++;
                }
            }
            $user = new User();
            $admin = $user->where('is_admin', '=', 1)->get();
            foreach ($admin as $a) {
                Notifications::create([
                    'user_id' => $a->id,
                    'lodge_id' => $lodge->id,
                    'requested_from' => auth()->user()->id,
                    'notification_type' => 'house_pending_verification',
                    'message' => auth()->user()->username . ' just uploaded new lodge details',
                    'link' => '/admin/lodges/' . $lodge->id,
                    'status' => 'unread'
                ]);
            }
        }

        return redirect('/agent/houses');
    }

    public function update(Request $request, Lodge $lodge_id)
    {
        $request->validate([
            'location' => ['required', 'min:3', 'max:30', 'string',],
            'type' => ['required', 'min:2', 'max:30', 'string',],
            'who_can_rent' => ['required', 'min:3', 'max:30', 'string',],
            'department' => ['required', 'min:3', 'max:30', 'string',],
            'description' => ['required', 'min:3', 'max:255', 'string',],
            'level' => ['required', 'min:3', 'max:30', 'string'],
        ]);
        $lodge_id->update([
            'location' => $request->location,
            'type' => $request->type,
            'who_can_rent' => $request->who_can_rent,
            'department' => $request->department,
            'description' => $request->description,
            'level' => $request->level,
            'approval_status' => 'pending'
        ]);
        $user = new User();
        $admin = $user->where('is_admin', '=', 1)->get();
        foreach ($admin as $a) {
            Notifications::create([
                'user_id' => $a->id,
                'lodge_id' => $lodge_id->id,
                'requested_from' => auth()->user()->id,
                'notification_type' => 'house_pending_verification',
                'message' => auth()->user()->username . ' just updated new lodge details',
                'link' => '/admin/lodges/' . $lodge_id->id,
                'status' => 'unread'
            ]);
        }
        return back()->with('success', 'Lodge Info Updated');
    }
}
