<?php

namespace App\Http\Controllers;

use App\Models\Followup;
use Illuminate\Http\Request;

class FollowupController extends Controller
{
    //
    public function index() {
        //$followup = Followup::all();
        $followups = Followup::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
        return view('followup.index', ['followups'=>$followups]);
    }

    public function showFollowupById($id,$object) {
        //$followup = Followup::all();
            // Check if the object is 'clockin'
    if ($object === 'clockin') {
        // Fetch followup based on clockin ID via visits
        $followup = Followup::whereHas('visit', function ($query) use ($id) {
            $query->where('clockin_id', $id);
        })->with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
    } else{
        $followup = Followup::with(['user' => function ($query) {
            $query->withTrashed();
        }])->where($object.'_id',$id)->get();
    }
        return view('followup.show', ['followup'=>$followup]);
    }


    public function deleteFollowup($id){
        $followup = Followup::find($id);
        $followup->delete();
        return redirect('/followups');
    }
    public function showEditFollowup($id){
        //$followup = Followup::find($id);
        $followup = Followup::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get()->find($id);
        return view('followup.edit',['followup'=>$followup]);
    }

    public function saveEditFollowup($id, Request $request){

        // $organization_id=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'description'=>'required|string|max:3000',
            'type'=>'required|string|max:255',
            'status'=>'required|string|max:255',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 
        ]);

        $incomingFields['description']=strip_tags($request['description']);
        $incomingFields['type']=strip_tags($request['type']);
        $incomingFields['status']=strip_tags($request['status']);
        $incomingFields['date']=strip_tags($request['date']);
        $incomingFields['time']=strip_tags($request['time']);
        $incomingFields['organization_id']=auth()->user()->organization_id;
        $incomingFields['team_id']=auth()->user()->team_id;
        // $incomingFields['organization_id']=$organization_id;
        
        $followup=Followup::find($id);

        $followup->update($incomingFields);

        return redirect('/followups');
        
    }
}
