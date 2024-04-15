<?php

namespace App\Http\Controllers\api;

use App\Models\Visit;
use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OutletController extends Controller
{
    //
    public function addoutlet(Request $request){

       
        // $incomingFields=$request->validate([
        //     'userId'=>'required',
        //     'time'=>'required',
        //     'lat'=>'required',
        //     'long'=>'required'
        // ]);

        $outletStatus=DB::transaction(function () use($request) {
    
        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['name']=strip_tags($request['outletName']);
        $incomingFields['contact_person_name']=strip_tags($request['contactPersonName']);
        $incomingFields['phone']=strip_tags($request['phone']);
        $incomingFields['lat']=strip_tags($request['lat']);
        $incomingFields['long']=strip_tags($request['long']);

        $outlet=Outlet::create($incomingFields);

        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['checkin_time']=strip_tags($request['time']);
        $incomingFields['checkin_latitude']=strip_tags($request['lat']);
        $incomingFields['checkin_longitude']=strip_tags($request['long']);
        $incomingFields['outlet_id']=strip_tags($outlet['id']);

        $incomingFields['checkout_latitude']="";
        $incomingFields['checkout_longitude']="";
        $incomingFields['checkout_time']="";
        $incomingFields['duration']="";

        $visit=Visit::create($incomingFields);

        $outletStatus=array(
            "message" => "Add Outlet Successful",
            "status" => "success",
        "outletId"=>$outlet['id'],
        "visitId"=>$visit['id']);

        return $outletStatus;

        });

        return response()->json($outletStatus);

}
    //
    public function index(){
        $outlets = Outlet::with('user')->get();
        return response()->json(['outlets'=>$outlets]);
    }

}
