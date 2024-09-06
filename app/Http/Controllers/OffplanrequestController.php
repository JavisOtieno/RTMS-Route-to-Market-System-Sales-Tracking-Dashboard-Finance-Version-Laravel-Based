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

    public function showEditOffplanrequest($id){
        $offplanrequest = Offplanrequest::find($id);
        return view('offplanrequest.edit',compact('offplanrequest'));
    }

    public function saveEditOffplanrequest($id, Request $request){

        $incomingFields=$request->validate([
            'status'=>'required|string|max:255'
        ]);
        
        $incomingFields['status']=strip_tags($incomingFields['status']);

        $offplanrequest=Offplanrequest::find($id);

        $offplanrequest->update($incomingFields);

        return redirect('/offplanrequests');
        
    }

}
