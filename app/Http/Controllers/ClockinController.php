<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use App\Models\Clockin;
use Illuminate\Http\Request;

class ClockinController extends Controller
{
    //
    public function apiindex(){
        $clockins = Clockin::all();
        return response()->json(['clockins'=>$clockins]);
    }
    public function index() {
        //$clockins = Clockin::all();
        $clockins = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();

        return view('clockins', ['clockins'=>$clockins]);
    }
    public function showClockinsById($objectId,$object) {
        //$clockins = Clockin::all();
        $clockins = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }])->where($object.'_id',$objectId)->get();

        return view('clockins', ['clockins'=>$clockins]);
    }
    public function showEditClockin($id){
        // $clockin = Clockin::find($id);
        $clockin = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get()->find($id);
        return view('edit-clockin',['clockin'=>$clockin]);
    }
    public function showClockinsMap(){
        $clockins = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();


        $users = User::inOrganization()->where('usertype','seller')->get();
   
        return view('clockinsmap', compact('clockins','users') );
    }
    // public function showEditClockin(Request $request){
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $clockin = Clockin::find($incomingFields['id']);
    //     return view('edit-clockin',['clockin'=>$clockin]);
    // }
}
