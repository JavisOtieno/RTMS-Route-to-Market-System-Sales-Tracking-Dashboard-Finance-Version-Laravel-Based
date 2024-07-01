<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
        //
        public function index() {
            //$visits = Visit::all();
            $visits = Visit::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get();
            return view('visits', ['visits'=>$visits]);
        }

        public function showEditVisit($id){
            //$visit = Visit::find($id);
            $visit=Visit::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get()->find($id);
            return view('edit-visit',['visit'=>$visit]);
        }

        // public function showEditVisit(Request $request){
        //     $incomingFields=$request->validate([
        //         'id'=>'required|numeric|digits_between:1,11'
        //     ]);
        //     $visit = Visit::find($incomingFields['id']);
        //     return view('edit-visit',['visit'=>$visit]);
        // }

}
