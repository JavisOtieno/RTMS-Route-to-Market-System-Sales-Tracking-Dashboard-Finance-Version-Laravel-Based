<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Clockin;
use Illuminate\Http\Request;

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
            'userId'=>'required|numeric|digits_between:1,20|exists:users,id',
            'time'=>'required|string|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'long'=>'required|numeric|between:-180,180'
        ]);

        //Test Git


        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
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
