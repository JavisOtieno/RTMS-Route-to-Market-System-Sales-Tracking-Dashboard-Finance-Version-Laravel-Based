<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
        //
        public function apiindex(){
            $visits = Visit::all();
            return response()->json(['visits'=>$visits]);
        }
        public function index() {
            $visits = Visit::all();
            return view('visits', ['visits'=>$visits]);
        }
}
