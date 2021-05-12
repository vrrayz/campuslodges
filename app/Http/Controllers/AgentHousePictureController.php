<?php

namespace App\Http\Controllers;

use App\Lodge;
use App\LodgePicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgentHousePictureController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);

    }

    public function show($lodge_id)
    {
        $lodge = auth()->user()->lodge->find($lodge_id);
        return view('agent.housePicutres', ['lodge' => $lodge]);
    }

    public function update(Request $request, LodgePicture $lodge_pic_id)
    {
//        dd($lodge_pic_id);
        $request->validate([
            'house_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $name = $request->house_pic->getClientOriginalName();
        $request->house_pic->move(public_path() . '/house_images/', $name);
        Storage::delete('/house_images/' . $lodge_pic_id->lodge_pic);
        $lodge_pic_id->lodge_pic = $name;
        $lodge_pic_id->update();
        return back()->with('photo_success', 'Photo Updated Successfully');
//        dd($name);
    }

    public function updateCategory(Request $request, LodgePicture $lodge_pic_id)
    {
//        dd($lodge_pic_id);
        $request->validate([
            'category' => 'required|string|min:3|max:40',
        ]);
        $lodge_pic_id->category = $request->category;
        $lodge_pic_id->update();
        return back()->with('category_success', 'Photo Category Updated Successfully');
//        dd($name);
    }
    public function delete(LodgePicture $lodge_pic_id){
        $lodge_pic_id->delete();
        return back()->with('delete_success', 'Photo Deleted Successfully');
    }

}
