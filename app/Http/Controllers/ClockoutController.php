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
            return view('clockout.index', ['clockouts'=>$clockouts]);
        }
        public function showClockoutsById($objectId,$object) {
            //$clockouts = Clockout::all();
            $clockouts = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }])->where($object.'_id',$objectId)->get();
            return view('clockout.index', ['clockouts'=>$clockouts]);
        }
                public function filterClockouts(Request $request) {
            //$visits = Visit::all();
            $query = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }]); // Eager load relationships for efficiency
    
            if ($request->user) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->user . '%');
                });
            }
        
            if ($request->from_date) {
                $query->whereDate('created_at', '>=', $request->from_date);
            }
        
            if ($request->to_date) {
                $query->whereDate('created_at', '<=', $request->to_date);
            }
            if ($request->from_time) {
                $query->whereRaw("TIME(created_at) >= ?", [$request->from_time]);
            }
            if ($request->to_time) {
                $query->whereRaw("TIME(created_at) <= ?", [$request->to_time]);
            }
                // Retrieve the current page from the request, defaulting to 1 if not set.
            $currentPage = $request->input('page', 1);
            
    
            // Explicitly pass the current page to the paginate() method.
            $clockouts = $query->orderBy('id', 'DESC')->paginate(500, ['*'], 'page', $currentPage);
    
            // $visits = $query->orderBy('id', 'DESC')->paginate(500);
            return response()->json(['clockouts'=>$clockouts]);
        }

        public function showEditClockout($id){
            //$clockout = Clockout::find($id);
            $clockout = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get()->find($id);
            return view('clockout.edit',['clockout'=>$clockout]);
        }

        public function showClockoutsMap(){
            $clockouts = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get();

           
            $users = User::inOrganization()->where('usertype','seller')->get();
           
            return view('clockout.map', compact('clockouts','users') );
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
