<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\ProfilePicture;
use App\Property;
use App\PropertyPicture;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SellPropertiesPictureController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);

    }

    public function show($property){
        $property = auth()->user()->property->find($property);
        return view('user.properties.photos',['property'=>$property]);
    }
//    public function update(Request $request,Property $property,PropertyPicture $photo){
//        $request->validate([
//            'property_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
//        ]);
//        $name = auth()->user()->id.'_'.time().'.'.$request->property_pic->getClientOriginalExtension();
//        $request->property_pic->move(public_path() . '/properties/', $name);
//        $photo->update([
//            'property_pic' => $name,
//        ]);
//        return back()->with('photo_success', 'Photo Updated Successfully');
//    }
    public function delete(Request $request,Property $property,PropertyPicture $photo){
//        $photo->delete();
        $num_of_pics = count($property->propertyPicture()->get());
        if ($num_of_pics == 1){
            return response()->json(['error'=>'You can\'t delete the last picture']);
        }
        if ($photo->property->id == $property->id && $photo->property->user->id == auth()->user()->id){
            $photo->property->approval_status = 'pending';
            $photo->property->update();
            $photo->delete();
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
            return response()->json(['success'=>"Deleted Successfully"]);
        }
        return response()->json(['error'=>"Error Deleting Picture"]);
    }
    public function store(Request $request, Property $property){
        $validator = Validator::make($request->all(),[
            'property_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->passes()){
            $name = auth()->user()->id.'_'.time().'.'.$request->property_pic->getClientOriginalExtension();
            $request->property_pic->move(public_path() . '/properties/', $name);
            $prop = $property->propertyPicture()->create([
                'property_pic' => $name,
            ]);
            $property->approval_status = 'pending';
            $property->update();
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
            return response()->json([
                'property_id'=>$prop->id,
                'pic_name'=>$prop->property_pic,
            ]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);

    }
}
