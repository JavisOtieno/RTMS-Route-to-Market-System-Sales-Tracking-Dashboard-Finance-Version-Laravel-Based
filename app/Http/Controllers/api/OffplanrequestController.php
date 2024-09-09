<?php

namespace App\Http\Controllers\api;

use App\Models\Routeplan;
use Illuminate\Http\Request;
use App\Models\Offplanrequest;
use App\Http\Controllers\Controller;
use App\Models\RouteplanItem;

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

        // $routeplan=Routeplan::find($incomingFields['routeplan_id']);
        // //for loop get latest visit
        
        // foreach ($routeplan['routeplanitems'] as $routeplanitem) {
        //     # code...
        //     $routeplanitem[''];
        // }

        //check last offplan route plan state if matches this route plan state
        //if yes dont create new request
        //return that request instead

        $lastOffPlanRequest=Offplanrequest::where('routeplan_id',$incomingFields['routeplan_id'])
        ->where('user_id',$incomingFields['user_id'])
        ->orderBy('id', 'desc')
        ->first();
        
        //no need to verify user id on routeplanitem as it is already confirmed by the
        //userrouteplan on initial mobile
        $routeplanitem=RouteplanItem::where('routeplan_id',$incomingFields['routeplan_id'])
        ->whereNotNull('visit_id')
        ->orderBy('id', 'desc')
        ->first();

        if($routeplanitem==null){
            // $incomingFields['visit_id']=0;
            $incomingFields['visit_id']=null;
            // visit id is null
        }else{
            $incomingFields['visit_id']=$routeplanitem['visit_id'];
        }

        $requestmadeonrouteplanstate = null;
        
        if($lastOffPlanRequest==null){
            $offplanrequest=Offplanrequest::create($incomingFields);
            $offplanrequestId=$offplanrequest->id;
            // $message="offplan null";
        }else if($incomingFields['visit_id']==$lastOffPlanRequest['visit_id']
        // && $lastOffPlanRequest['status'] == 'pending'
        )
        {
            $offplanrequestId=$lastOffPlanRequest->id;
            $requestmadeonrouteplanstate = $lastOffPlanRequest->status;
            
            // $message="offplan and incoming not equal";
        }else{
            $offplanrequest=Offplanrequest::create($incomingFields);
            $offplanrequestId=$offplanrequest->id;
            
            // $message = "else statement";
        }

        $offplanStatus=array(
            "message" => "Offplan Request Saved Successfully ",
            "equalrequeststatus" => $requestmadeonrouteplanstate,
                    //    "op ".$lastOffPlanRequest['visit_id']." rt ".$routeplanitem['visit_id']." ic".$incomingFields['routeplan_id']." m ".$message,
            "offplanrequestId" => $offplanrequestId,
            "status" => "success");

        return response()->json($offplanStatus);
        
    }
    public function checkIfOffplanrequestApproved($id) {
        $offplanrequest = Offplanrequest::find($id);
        return response()->json($offplanrequest);
    }


}
