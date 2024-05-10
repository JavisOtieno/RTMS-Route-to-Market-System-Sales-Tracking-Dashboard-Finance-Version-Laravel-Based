<?php

namespace App\Http\Controllers;

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
            $clockouts = Clockout::all();
            return view('clockouts', ['clockouts'=>$clockouts]);
        }

        public function showEditClockout($id){
            $clockout = Clockout::find($id);
            return view('edit-clockout',['clockout'=>$clockout]);
        }

}
