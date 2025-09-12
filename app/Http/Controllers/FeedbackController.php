<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Imports\ImportFeedback;
use Maatwebsite\Excel\Facades\Excel;

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
        },
        'outlet' => function ($query) {
            $query->withTrashed();
        },
        'outlet.region',        // <--- eager load region
        'outlet.territory',     // <--- eager load territory
        'team', 
        ])->get();
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

    public function showAddFeedback($id){
        //$feedback = Feedback::find($id);
        $visit = Visit::with(['outlet','user' => function ($query) {
            $query->withTrashed();
        }])->get()->find($id);
        return view('feedback.add',['visit'=>$visit]);
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
    public function importView(Request $request){
        return view('importFile');
    }

    public function import(Request $request){

        Excel::import(new ImportFeedback, 
                      $request->file('file')->store('files'));
        return redirect()->back();

        // Store the file and get the relative path
        // $path = $request->file('file')->store('files');

        // // Get the full path of the file from storage
        // $fullPath = storage_path('app/' . $path);

        // // Import the file
        // Excel::import(new ImportRoute, $fullPath);

        // return redirect()->back();
    
    }

    public function saveFeedback(Request $request){

        // $organization_id=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'user_id'=>'required|numeric|digits_between:1,20|exists:users,id',
            'visit_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            'outlet_id'=>'required|numeric|digits_between:1,20|exists:outlets,id',
            'feedback' => 'required',
        ]);

        $incomingFields['feedback']=strip_tags($incomingFields['feedback']);
        // $visit_id = strip_tags($incomingFields['visit_id']);
        $visit = Visit::find($incomingFields['visit_id']);
        // $incomingFields['organization_id']=$organization_id;

        $incomingFields['organization_id']=$visit->organization_id;
        $incomingFields['team_id']=$visit->team_id;
        // $incomingFields['created_at']=$visit->created_at;
        function durationToSeconds(?string $duration): int
        {
            if (empty($duration)) {
                return -1; // signal "null/empty"
            }

            $parts = array_reverse(explode(':', trim($duration)));
            $seconds = 0;

            if (isset($parts[0])) $seconds += (int) $parts[0];          // seconds
            if (isset($parts[1])) $seconds += (int) $parts[1] * 60;     // minutes
            if (isset($parts[2])) $seconds += (int) $parts[2] * 3600;   // hours

            return $seconds;
        }

        $durationSeconds = durationToSeconds($visit->duration);

        if ($durationSeconds === -1) {
            // null or empty → use max = 2 minutes
            $randSeconds = random_int(1, 120);
        } elseif ($durationSeconds === 0) {
            // duration = zero → add 0 seconds
            $randSeconds = 0;
        } else {
            // duration > 0 → pick between 1 and that duration
            $randSeconds = random_int(1, $durationSeconds);
        }

        // $incomingFields['created_at'] = $visit->created_at->copy()->addSeconds($randSeconds);
        // $incomingFields['updated_at'] = $visit->created_at->copy()->addSeconds($randSeconds);


        $feedback = Feedback::create($incomingFields);

        $incomingFields2['created_at'] = $visit->created_at->copy()->addSeconds($randSeconds);
        $incomingFields2['updated_at'] = $visit->created_at->copy()->addSeconds($randSeconds);
        $feedback->update($incomingFields2);

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
