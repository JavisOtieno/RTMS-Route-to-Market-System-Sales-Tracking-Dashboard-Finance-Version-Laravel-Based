<?php

namespace App\Http\Controllers;

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
        $clockins = Clockin::all();
        return view('clockins', ['clockins'=>$clockins]);
    }
    public function showEditClockin($id){
        $clockin = Clockin::find($id);
        return view('edit-clockin',['clockin'=>$clockin]);
    }
}
