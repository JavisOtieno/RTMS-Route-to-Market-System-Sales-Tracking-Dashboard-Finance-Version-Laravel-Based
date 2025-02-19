<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    //
    public function apiindex(){
        $feedback = Feedback::all();
        return response()->json(['feedback'=>$feedback]);
    }
    
    public function index() {
        //$feedback = Feedback::all();
        $feedback = Feedback::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
        return view('feedback', ['feedback'=>$feedback]);
    }

    public function showFeedbackById($id,$object) {
        //$feedback = Feedback::all();
            // Check if the object is 'clockin'
    if ($object === 'clockin') {
        // Fetch feedback based on clockin ID via visits
        $feedback = Feedback::whereHas('visit', function ($query) use ($id) {
            $query->where('clockin_id', $id);
        })->with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
    } else{
        $feedback = Feedback::with(['user' => function ($query) {
            $query->withTrashed();
        }])->where($object.'_id',$id)->get();
    }
        return view('feedback', ['feedback'=>$feedback]);
    }


    public function deleteFeedback($id){
        $feedback = Feedback::find($id);
        $feedback->delete();
        return redirect('/feedback');
    }
    public function showEditFeedback($id){
        //$feedback = Feedback::find($id);
        $feedback = Feedback::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get()->find($id);
        return view('edit-feedback',['feedback'=>$feedback]);
    }

    public function saveEditFeedback($id, Request $request){

        // $organization_id=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'feedback' => 'required',
        ]);

        $incomingFields['feedback']=strip_tags($incomingFields['feedback']);
        // $incomingFields['organization_id']=$organization_id;
        
        $feedback=Feedback::find($id);

        $feedback->update($incomingFields);

        return redirect('/feedback');
        
    }
    
    // public function showEditFeedback(Request $request){
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $feedback = Feedback::find($incomingFields['id']);
    //     return view('edit-feedback',['feedback'=>$feedback]);
    // }

}
