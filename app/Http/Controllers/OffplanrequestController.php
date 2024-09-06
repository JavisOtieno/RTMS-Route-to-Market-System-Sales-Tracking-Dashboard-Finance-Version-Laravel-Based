<?php

namespace App\Http\Controllers;

use App\Models\Offplanrequest;
use Illuminate\Http\Request;

class OffplanrequestController extends Controller
{
    //
    public function index() {
        //$feedback = Feedback::all();
        $offplanrequests = Offplanrequest::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
        return view('offplanrequest.index', ['offplanrequests'=>$offplanrequests]);
    }
}
