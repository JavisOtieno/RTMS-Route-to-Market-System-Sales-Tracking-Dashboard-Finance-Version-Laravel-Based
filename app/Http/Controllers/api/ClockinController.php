<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Clockin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClockinController extends Controller
{
    //
    public function saveClockin(Request $request){

       // $incomingFields=
        $incomingFields=$request->validate([
            //'userId'=>'required',
            //'time'=>'required',
            // 'lat'=>'required',
            // 'long'=>'required'
            // 'userId'=>'required|numeric|digits_between:1,20|exists:users,id',
            'time'=>'required|string|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'long'=>'required|numeric|between:-180,180'
        ]);

        //Test Git
        $userid = auth()->user()->id;

        // Fetch the latest clock-in record for the user
        $latestClockIn = ClockIn::where('user_id', $userid)
        ->orderBy('created_at', 'desc')
        ->first();

        // Get today's date
        $today = Carbon::today();

        // Check if the latest clock-in exists and its date matches today
        if ($latestClockIn && $latestClockIn->created_at->isSameDay($today)) {
            // Do something if the latest clock-in was created today
            return response()->json(["errors" => "Multiple Clockin Attempt",
            'message' => 'Already clocked in today.']);
        } else {
        
        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['user_id']=$userid;
        $incomingFields['time']=strip_tags($request['time']);
        $incomingFields['time']=time();
        $incomingFields['lat']=strip_tags($request['lat']);
        $incomingFields['long']=strip_tags($request['long']);
        $incomingFields['organization_id']=auth()->user()->organization_id;
        $incomingFields['team_id']=auth()->user()->team_id;

        $clockin=Clockin::create($incomingFields);

        $clockinStatus=array(
            "message" => "Clockin Successful",
            "clockinId"=>$clockin['id'],
            "status" => "success");

        return response()->json($clockinStatus);
        }
        
    }

    // public function clockinTest(Request $request){

    //     // $incomingFields=
    //      $incomingFields=$request->validate([
    //          //'userId'=>'required',
    //          //'time'=>'required',
    //          // 'lat'=>'required',
    //          // 'long'=>'required'
    //          'lat' => 'required|numeric|between:-90,90',
    //          'long'=> 'required|numeric|between:-180,180'
    //      ]);
 
    //      //Test Git
 
 
    //      $incomingFields=[];
    //      $incomingFields['user_id']=1;
    //      $incomingFields['time']=strip_tags($request['time']);
    //      $incomingFields['time']=time();
    //      $incomingFields['lat']=strip_tags($request['lat']);
    //      $incomingFields['long']=strip_tags($request['long']);
    //      $incomingFields['organization_id']=1;
    //      $incomingFields['team_id']=null;
 
    //      $clockin=Clockin::create($incomingFields);
 
    //      $clockinStatus=array(
    //          "message" => "Clockin Successful",
    //          "clockinId"=>$clockin['id'],
    //          "status" => "success");
 
    //      return response()->json($clockinStatus);
         
    //  }
}
