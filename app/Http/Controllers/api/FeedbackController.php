<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    
    public function saveFeedback(Request $request){

       
        //$incomingFields=
        $request->validate([
            'userId'=>'required|numeric|digits_between:1,20|exists:users,id',
            'visitId'=>'required|numeric|digits_between:1,20|exists:visits,id',
            'outletId'=>'required|numeric|digits_between:1,20|exists:outlets,id',
            'feedback'=>'required',
        ]);


        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['visit_id']=strip_tags($request['visitId']);
        $incomingFields['outlet_id']=strip_tags($request['outletId']);
        $incomingFields['feedback']=strip_tags($request['feedback']);
        $incomingFields['organization_id']=auth()->user()->organization_id;


        Feedback::create($incomingFields);

        $feedbackStatus=array(
            "message" => "Feedback Saved Successfully",
            "status" => "success");

        return response()->json($feedbackStatus);
        
    }

    public function index(){
        //$sales = Sale::all();
        $userId = auth()->id();
        $feedback = Feedback::where('user_id',$userId)->orderBy('id', 'DESC')->with('user','outlet')->get();
        return response()->json(['feedback'=>$feedback]);
    }

    public function visitFeedback(Request $request){
        //$sales = Sale::all();
        $incomingFields=$request->validate([
            'visitId'=>'required',
        ]);
        $visitId=strip_tags($request['visitId']);

        $userId = auth()->id();
        $feedback = Feedback::where('visit_id', $visitId)->where('user_id',$userId)->with('user','visit','outlet')->orderBy('id', 'DESC')->get();
        return response()->json(['feedback'=>$feedback]);
    }


    

}
