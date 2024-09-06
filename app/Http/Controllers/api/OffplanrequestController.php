<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Offplanrequest;
use Illuminate\Http\Request;

class OffplanrequestController extends Controller
{
    //
    public function saveOffplanrequest(Request $request){

        //$incomingFields=
        $request->validate([
            'userId'=>'required|numeric|digits_between:1,20|exists:users,id',
            'routeplanId'=>'required|numeric|digits_between:1,20|exists:routeplans,id',
        ]);


        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['routeplan_id']=strip_tags($request['routeplanId']);
        $incomingFields['status']='pending';
        $incomingFields['organization_id']=auth()->user()->organization_id;
        $incomingFields['team_id']=auth()->user()->team_id;

        Offplanrequest::create($incomingFields);

        $offplanStatus=array(
            "message" => "Offplan Request Saved Successfully",
            "status" => "success");

        return response()->json($offplanStatus);
        
    }


}
