<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
        //
        public function index() {
            $visits = Visit::all();
            return view('visits', ['visits'=>$visits]);
        }

        public function showEditVisit($id){
            $visit = Visit::find($id);
            return view('edit-visit',['visit'=>$visit]);
        }
}
