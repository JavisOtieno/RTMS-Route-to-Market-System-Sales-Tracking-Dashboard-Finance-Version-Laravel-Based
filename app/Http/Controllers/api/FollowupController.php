<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Followup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowupController extends Controller
{
    public function saveFollowup(Request $request){


        // $table->string('type');
        // $table->longText('description');
        // $table->string('status');
        // $table->string('date');
        // $table->string('time');

       
        //$incomingFields=
        $request->validate([
            'visitId'=>'nullable|numeric|digits_between:1,20|exists:visits,id',
            'outletId'=>'required|numeric|digits_between:1,20|exists:outlets,id',
            // ''=>'required',

            'description'=>'required|string|max:3000',
            'type'=>'required|string|max:255',
            'status'=>'required|string|max:255',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 
        ]);


        $incomingFields=[];
        $incomingFields['user_id']=auth()->id();
        $incomingFields['visit_id']=strip_tags($request['visitId']);
        $incomingFields['outlet_id']=strip_tags($request['outletId']);

        if($incomingFields['visit_id']==""){
            $incomingFields['visit_id']=null;
        }

        $incomingFields['description']=strip_tags($request['description']);
        $incomingFields['type']=strip_tags($request['type']);
        $incomingFields['status']=strip_tags($request['status']);
        
        $incomingFields['date']=strip_tags($request['date']);
        $incomingFields['time']=strip_tags($request['time']);
        $incomingFields['organization_id']=auth()->user()->organization_id;
        $incomingFields['team_id']=auth()->user()->team_id;


        Followup::create($incomingFields);

        $followupStatus=array(
            "message" => "Followup Saved Successfully",
            "status" => "success");

        return response()->json($followupStatus);
        
    }

    public function saveEditFollowup(Request $request,$id){


        // $table->string('type');
        // $table->longText('description');
        // $table->string('status');
        // $table->string('date');
        // $table->string('time');

       
        //$incomingFields=
        $request->validate([
   
            // ''=>'required',

            'description'=>'required|string|max:3000',
            'type'=>'required|string|max:255',
            'status'=>'required|string|max:255',
            // 'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 
        ]);


        $incomingFields=[];

        $incomingFields['description']=strip_tags($request['description']);
        $incomingFields['type']=strip_tags($request['type']);
        $incomingFields['status']=strip_tags($request['status']);
        // $incomingFields['date']=strip_tags($request['date']);
        $incomingFields['time']=strip_tags($request['time']);
        $incomingFields['organization_id']=auth()->user()->organization_id;
        $incomingFields['team_id']=auth()->user()->team_id;


        $followup = Followup::find($id);
        $followup->update($incomingFields);

        $followupStatus=array(
            "message" => "Followup Edited Successfully",
            "status" => "success");

        return response()->json($followupStatus);
        
    }
    public function followupsOnThisDate($date){

        // $incomingFields = $request->validate(['date'=>'required|string|max:255']);
        // $selectedDate = $incomingFields['date'];
        $date = Carbon::createFromFormat('Y-m-d', $date)->startOfDay();
        $userId = auth()->id();
        
        $followups = Followup::where('user_id',$userId)->orderBy('id', 'DESC')->with('user','outlet')
        ->whereDate('date', '=', $date)->orderBy('id', 'ASC')->get();

        return response()->json(['followup'=>$followups]);

    }

    public function index(){
        //$sales = Sale::all();
        $userId = auth()->id();
        $followup = Followup::where('user_id',$userId)->orderBy('id', 'DESC')->with('user','outlet')->get();
        return response()->json(['followup'=>$followup]);
    }

}
