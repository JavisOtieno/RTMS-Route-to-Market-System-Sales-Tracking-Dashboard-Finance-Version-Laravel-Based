<?php

namespace App\Http\Controllers;

use App\Models\Posaudit;
use Illuminate\Http\Request;

class PosauditController extends Controller
{
    //
    public function apiindex(){
        $posaudits = Posaudit::all();
        return response()->json(['posaudits'=>$posaudits]);
    }
    public function index() {
        $posaudits = Posaudit::all();
        return view('posaudits', ['posaudits'=>$posaudits]);
    }
}
