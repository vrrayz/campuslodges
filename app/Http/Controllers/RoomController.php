<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin')->except(['getRoomType']);
    }
    public function index(){
        $room = new Room();
        $room = $room->paginate(5);
        return view('admin.room.index',['rooms'=>$room]);
    }
    public function store(Request $request){
        $request->validate([
            'vicinity' => ['required'],
            'type' => ['required'],
        ]);
        Room::create([
            'vicinity' => $request->vicinity,
            'type' => $request->type,
        ]);
        return back()->with('success',$request->type.' added successfully');
    }
    public function destroy(Room $roomType){
        $roomType->delete();
        return back()->with('success','Room Deleted Successfully');
    }
    public function getRoomType($vicinity){
        $room = Room::where('vicinity',$vicinity)->pluck('type','id');
        return json_encode($room);
    }
}
