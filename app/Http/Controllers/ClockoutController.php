<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use App\Models\Clockout;
use Illuminate\Http\Request;

class ClockoutController extends Controller
{
    //
        //
        public function apiindex(){
            $clockouts = Clockout::all();
            return response()->json(['clockouts'=>$clockouts]);
        }
        public function index() {
            //$clockouts = Clockout::all();
            $clockouts = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get();
            return view('clockouts', ['clockouts'=>$clockouts]);
        }

        public function showEditClockout($id){
            //$clockout = Clockout::find($id);
            $clockout = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get()->find($id);
            return view('edit-clockout',['clockout'=>$clockout]);
        }

        public function showClockoutsMap(){
            $clockouts = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get();

           
            $users = User::inOrganization()->where('usertype','seller')->get();
           
            return view('clockoutsmap', compact('clockouts','users') );
        }

        public function deleteClockout($id){
            $clockout = Clockout::find($id);
            $clockout->delete();
            return redirect('/clockouts');
        }

        // public function showEditClockout(Request $request){
        //     $incomingFields=$request->validate([
        //         'id'=>'required|numeric|digits_between:1,11'
        //     ]);
        //     $clockout = Clockout::find($incomingFields['id']);
        //     return view('edit-clockout',['clockout'=>$clockout]);
        // }

}
