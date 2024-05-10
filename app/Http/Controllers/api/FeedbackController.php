<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    
    public function saveFeedback(Request $request){

       
        $incomingFields=$request->validate([
            'feedback'=>'required',
        ]);


        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['visit_id']=strip_tags($request['visitId']);
        $incomingFields['outlet_id']=strip_tags($request['outletId']);
        $incomingFields['feedback']=strip_tags($request['feedback']);

        Feedback::create($incomingFields);

        $feedbackStatus=array(
            "message" => "Feedback Saved Successfully",
            "status" => "success");

        return response()->json($feedbackStatus);
        
    }

    public function index(){
        //$sales = Sale::all();
        $userId = auth()->id();
        $feedback = Feedback::where('user_id',$userId)->with('user','outlet')->get();
        return response()->json(['feedback'=>$feedback]);
    }

}
