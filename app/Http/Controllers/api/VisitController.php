<?php

namespace App\Http\Controllers\api;

use App\Models\Visit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RouteplanItem;

class VisitController extends Controller
{
    //
    public function checkin(Request $request){

       
        // $incomingFields=
        $request->validate([
        //     'userId'=>'required',
        //     'time'=>'required',
        //     'lat'=>'required',
        //     'long'=>'required'
        //     'userId'=>'required|numeric|digits_between:1,11',
        'time'=>'required|string|max:255',
        'lat'=>'required|between:-90.000000000,90.000000000',
        'long'=>'required|between:-180.000000000,180.000000000',
        'outletId'=>'required|numeric|digits_between:1,20|exists:outlets,id',
        'clockinId'=>'required|numeric|digits_between:1,20|exists:clockins,id',
        'userId' => 'required|numeric|digits_between:1,20|exists:users,id',
        'routePlanItemId' => 'required|numeric|digits_between:1,20',
        
        ]);

        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['checkin_time']=strip_tags($request['time']);
        $incomingFields['checkin_latitude']=strip_tags($request['lat']);
        $incomingFields['checkin_longitude']=strip_tags($request['long']);
        $incomingFields['outlet_id']=strip_tags($request['outletId']);
        $incomingFields['clockin_id']=strip_tags($request['clockinId']);

        $incomingFields['checkout_latitude']="";
        $incomingFields['checkout_longitude']="";
        $incomingFields['checkout_time']="";
        $incomingFields['duration']="";
        $incomingFields['organization_id']=auth()->user()->organization_id;

        $visit=Visit::create($incomingFields);
        
        $routePlanItemId=strip_tags($request['routePlanItemId']);

        if($routePlanItemId!=0){
            
            $routeplanitem=RouteplanItem::find($routePlanItemId);
            $incomingFieldsRoutePlanItem=[];
            $incomingFieldsRoutePlanItem['visit_id']=$visit['id'];
            $routeplanitem->update($incomingFieldsRoutePlanItem);
                

        }

        
        $checkinStatus=array(
            "message" => "Checkin Successful",
            "status" => "success",
            "visitId"=>$visit['id'],
            "outletId"=>$incomingFields['outlet_id']
        );

        // $checkinStatus = $routeplanitem['outlet_id'];

        return response()->json($checkinStatus);


}
public function checkout($id,Request $request){

    $visit=Visit::find($id);
    
    $request->validate([
        //     'userId'=>'required',
        //     'time'=>'required',
        //     'lat'=>'required',
        //     'long'=>'required'
        'checkout_time'=>'required|string|max:255',
        'checkout_latitude'=>'required|between:-90.000000000,90.000000000',
        'checkout_longitude'=>'required|between:-180.000000000,180.000000000',
        ]);
    
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
    $visits = Visit::where('user_id',$userId)->with('outlet')->orderBy('id', 'DESC')->get();
    return response()->json(['visits'=>$visits]);
}
}