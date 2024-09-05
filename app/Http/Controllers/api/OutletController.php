<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\ApiCommonController;
use App\Models\Visit;
use App\Models\Outlet;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OutletController extends ApiCommonController
{
    //
    public function addoutlet(Request $request){
 
        $incomingFields=$request->validate([
            'userId'=>'required|numeric|digits_between:1,20|exists:users,id',
            'clockinId'=>'required|numeric|digits_between:1,20|exists:clockins,id',
            'outletName'=>'required|string|min:2|max:255',
            'contactPersonName'=>'required|string|min:2|max:255',
            'phone'=>['required','string','min:10','max:255', new PhoneNumber],
            'lat' => 'required|numeric|between:-90,90',
            'long' => 'required|numeric|between:-180,180',
            'time'=>'required|string|max:255'
        ]);

        $outletStatus=DB::transaction(function () use($request) {
    
        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);

        
        $contact_person_name=strip_tags($request['contactPersonName']);


    
        $incomingFields['contact_person_name']=$this->processName($contact_person_name);
        $incomingFields['name']=$this->processName(strip_tags($request['outletName']));

        $incomingFields['phone']=strip_tags($request['phone']);
        $incomingFields['lat']=strip_tags($request['lat']);
        $incomingFields['long']=strip_tags($request['long']);
        $incomingFields['image']="";
        $incomingFields['organization_id']=auth()->user()->organization_id;
        $incomingFields['team_id']=auth()->user()->team_id;

        $outlet=Outlet::create($incomingFields);

        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['checkin_time']=strip_tags($request['time']);
        $incomingFields['checkin_latitude']=strip_tags($request['lat']);
        $incomingFields['checkin_longitude']=strip_tags($request['long']);
        $incomingFields['outlet_id']=strip_tags($outlet['id']);
        $incomingFields['clockin_id']=strip_tags($request['clockinId']);

        $incomingFields['checkout_latitude']="";
        $incomingFields['checkout_longitude']="";
        $incomingFields['checkout_time']="";
        $incomingFields['duration']="";
        $incomingFields['organization_id']=auth()->user()->organization_id;
        $incomingFields['team_id']=auth()->user()->team_id;

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
        $userId = auth()->id();
        $outlets = Outlet::where('user_id',$userId)->orderBy('id', 'DESC')->with('user')->get();
        return response()->json(['outlets'=>$outlets]);
    }

}
