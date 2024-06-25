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
            'userId'=>'required|numeric|digits_between:1,11',
            'time'=>'required|string|max:255',
            'lat'=>'required|between:-90.000000000,90.000000000',
            'long'=>'required|between:-180.000000000,180.000000000'
        ]);

        //Test Git


        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['time']=strip_tags($request['time']);
        $incomingFields['lat']=strip_tags($request['lat']);
        $incomingFields['long']=strip_tags($request['long']);
        $incomingFields['organization_id']=auth()->user()->organization_id;

        Clockin::create($incomingFields);

        $clockinStatus=array(
            "message" => "Clockin Successful",
            "status" => "success");

        return response()->json($clockinStatus);
        
    }
}
