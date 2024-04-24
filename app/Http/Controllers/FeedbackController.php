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
        $feedback = Feedback::all();
        return view('feedback', ['feedback'=>$feedback]);
    }

    public function deleteFeedback($id){
        $feedback = Feedback::find($id);
        $feedback->delete();
        return redirect('/feedback');
    }
}
