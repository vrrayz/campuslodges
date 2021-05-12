<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\Property;
use App\User;
use Illuminate\Http\Request;

class SellPropertiesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function renew(Property $property){
        if ($property->user->id == auth()->user()->id){
            $p_time = time();
            $e_time = 0;

                $e_time += $p_time + (3600 * 24 * 7);//Set the expiry time of the lodge for off campus

            if ($property->approval_status != 'approved'){
                $property->update([
                    'availability' => 'unavailable',
                ]);
            }else{
                $property->update([
                    'availability' => 'available',
                ]);
            }
            $property->update([
                'posted_time' => $p_time,
                'expiry_time' => $e_time,
            ]);
            $user = new User();
            $admin = $user->where('is_admin', '=', 1)->get();
            foreach ($admin as $a) {
                Notifications::create([
                    'user_id' => $a->id,
                    'property_id' => $property->id,
                    'requested_from' => auth()->user()->id,
                    'notification_type' => 'property_pending_verification',
                    'message' => auth()->user()->username . ' just updated a property, waiting for your approval',
                    'link' => '/admin/properties/' . $property->id,
                    'status' => 'unread'
                ]);
            }
            return back()->with('success','Property Successfully Renewed');
        }
        return back();
    }
    public function index($approval_status)
    {
        $property = new Property();
        switch ($approval_status) {
            case 'denied':
                $property = $property->where([['approval_status', 'denied'],['availability','!=','expired'],['user_id', auth()->user()->id]])->paginate(12);
                break;
            case 'approved':
                $property = $property->where([['approval_status', 'approved'],['availability','!=','expired'],['user_id', auth()->user()->id]])->paginate(12);
                break;
            case 'pending':
                $property = $property->where([['approval_status', 'pending'],['availability','!=','expired'],['user_id', auth()->user()->id]])->paginate(12);
                break;
            case 'expired':
                $property = $property->where([['availability','expired'],['user_id', auth()->user()->id]])->paginate(12);
                break;
            default:
                return redirect('/user/properties/upload');
        }
        return view('user.properties.index', ['properties' => $property]);
    }

    public function show($property)
    {
        $prop = auth()->user()->property->find($property);
        $verification_notifications = auth()->user()->notification()->where([
            ['notification_type', '=', 'admin_response_property_verification'],
            ['property_id', '=', $prop->id],
        ])->orderBy('created_at', 'desc')->get();
//        foreach ($verification_notifications as $notification) {
//            $notification->status = 'read';
//            $notification->update();
//        }
//        dd($verification_notifications);
        return view('user.properties.show', ['property' => $prop, 'verification_notifications' => $verification_notifications]);
    }

    public function create()
    {
        return view('user.properties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required', 'min:3', 'max:255', 'string',],
            'name' => ['required', 'min:3', 'max:40', 'string',],
            'category' => ['required', 'min:3', 'max:255', 'string',],
            'condition' => ['required', 'min:3', 'max:255', 'string',],
            'price' => ['required', 'min:3', 'max:16', 'string',],
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if (count($request->file('filename')) > 5) {
            return back()->with('picture_amount', 'Pictures upload maximum is 5');
        } else {
            $property = new Property();
            $price = intval(str_replace(',', '', $request->price));
            $p_time = time();
            $e_time = 0;

            $e_time += $p_time + (3600 * 24 * 7);//Set the expiry time of the lodge for off campus
            $property = $property->create([
                'user_id' => auth()->user()->id,
                'description' => $request->description,
                'name' => $request->name,
                'category' => $request->category,
                'condition' => $request->condition,
                'amount' => $price,
                'posted_time' => $p_time,
                'expiry_time' => $e_time,
            ]);
            if ($request->hasFile('filename')) {
                $count = 0;
                foreach ($request->file('filename') as $image) {
                    $name = auth()->user()->id . '_' . time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path() . '/properties/', $name);
                    $property->propertyPicture()->create([
                        'property_pic' => $name,
                    ]);
                    $count++;
                }
            }
            $user = new User();
            $admin = $user->where('is_admin', '=', 1)->get();
            foreach ($admin as $a) {
                Notifications::create([
                    'user_id' => $a->id,
                    'property_id' => $property->id,
                    'requested_from' => auth()->user()->id,
                    'notification_type' => 'property_pending_verification',
                    'message' => auth()->user()->username . ' just uploaded a new property, waiting for your approval',
                    'link' => '/admin/properties/' . $property->id,
                    'status' => 'unread'
                ]);
            }
        }
//        dd($request->all());
        return redirect('/user/properties/pending')->with('update_success', 'Property created successfully');
    }

    public function update(Request $request, Property $property)
    {
        $request->validate([
            'description' => ['required', 'min:3', 'max:255', 'string',],
            'name' => ['required', 'min:3', 'max:255', 'string',],
            'category' => ['required', 'min:3', 'max:255', 'string',],
            'condition' => ['required', 'min:3', 'max:255', 'string',],
            'price' => ['required', 'min:3', 'max:16', 'string',],
        ]);
        $price = intval(str_replace(',', '', $request->price));
        $property->update([
            'description' => $request->description,
            'name' => $request->name,
            'category' => $request->category,
            'condition' => $request->condition,
            'amount' => $price,
            'approval_status' => 'pending',
            'availability' => 'unavailable'
        ]);
        $user = new User();
        $admin = $user->where('is_admin', '=', 1)->get();
        foreach ($admin as $a) {
            Notifications::create([
                'user_id' => $a->id,
                'property_id' => $property->id,
                'requested_from' => auth()->user()->id,
                'notification_type' => 'property_pending_verification',
                'message' => auth()->user()->username . ' just updated a property, waiting for your approval',
                'link' => '/admin/properties/' . $property->id,
                'status' => 'unread'
            ]);
        }
        return back()->with('success', 'Properties updated');
        dd($request->all());
    }
}
