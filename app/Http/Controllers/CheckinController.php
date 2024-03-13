<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    //
    public function apiindex(){
        $checkins = Checkin::all();
        return response()->json(['checkins'=>$checkins]);
    }
    public function index() {
        $checkins = Checkin::all();
        return view('checkins', ['checkins'=>$checkins]);
    }
}
