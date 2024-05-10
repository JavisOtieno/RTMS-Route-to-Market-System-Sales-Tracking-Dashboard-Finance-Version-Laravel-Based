<?php

namespace App\Http\Controllers\api;

use App\Models\Visit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitController extends Controller
{
    //
    public function checkin(Request $request){

       
        // $incomingFields=$request->validate([
        //     'userId'=>'required',
        //     'time'=>'required',
        //     'lat'=>'required',
        //     'long'=>'required'
        // ]);

        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['checkin_time']=strip_tags($request['time']);
        $incomingFields['checkin_latitude']=strip_tags($request['lat']);
        $incomingFields['checkin_longitude']=strip_tags($request['long']);
        $incomingFields['outlet_id']=strip_tags($request['outletId']);

        $incomingFields['checkout_latitude']="";
        $incomingFields['checkout_longitude']="";
        $incomingFields['checkout_time']="";
        $incomingFields['duration']="";

        $visit=Visit::create($incomingFields);

        $checkinStatus=array(
            "message" => "Checkin Successful",
            "status" => "success",
            "visitId"=>$visit['id'],
            "outletId"=>$incomingFields['outlet_id']);

        return response()->json($checkinStatus);

}
public function checkout($id,Request $request){

    $visit=Visit::find($id);
    
    $incomingFields['checkout_time']=strip_tags($request['checkout_time']);
    $incomingFields['checkout_latitude']=strip_tags($request['checkout_latitude']);
    $incomingFields['checkout_longitude']=strip_tags($request['checkout_longitude']);
    
    $visit->update($incomingFields);
    
    $checkoutStatus=array(
        "message" => "Checkout Successful",
        "status" => "success");

    return response()->json($checkoutStatus);

}
public function index(){
    //$sales = Sale::all();
    $userId = auth()->id();
    $visits = Visit::where('user_id',$userId)->with('outlet')->get();
    return response()->json(['visits'=>$visits]);
}
}