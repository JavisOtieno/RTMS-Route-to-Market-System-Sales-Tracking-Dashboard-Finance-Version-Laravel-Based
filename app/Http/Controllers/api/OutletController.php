<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Visit;
use App\Models\Outlet;
use App\Models\Region;
use App\Models\Followup;
use App\Models\Territory;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\ApiCommonController;

class OutletController extends ApiCommonController
{
    //
    public function addoutlet(Request $request){
 
        $incomingFields=$request->validate([
            'userId'=>'required|numeric|digits_between:1,20|exists:users,id',
            'clockinId'=>'required|numeric|digits_between:1,20|exists:clockins,id',
            'outletName'=>'required|string|min:2|max:255',
            'contactPersonName'=>'required|string|min:2|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'long' => 'required|numeric|between:-180,180',
            'time'=>'required|string|max:255'
        ]);

        if($request['phone']!=""){

        $request->validate([
            'phone'=>['required','string','min:10','max:255', new PhoneNumber],
        ]);
        
        }
        $incomingFields['phone']=strip_tags($request['phone']);

        $outletStatus=DB::transaction(function () use($request) {
    
        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['user_id']=auth()->id();

        
        $contact_person_name=strip_tags($request['contactPersonName']);


    
        $incomingFields['contact_person_name']=$this->processName($contact_person_name);
        $incomingFields['name']=$this->processName(strip_tags($request['outletName']));

        $incomingFields['phone']=strip_tags($request['phone']);
        $incomingFields['lat']=strip_tags($request['lat']);
        $incomingFields['long']=strip_tags($request['long']);
        $incomingFields['image']="";
        $incomingFields['organization_id']=auth()->user()->organization_id;
        $incomingFields['team_id']=auth()->user()->team_id;

        $incomingFields['region_id']=strip_tags($request['regionId']);
        if ($incomingFields['region_id'] === 0) {
            $incomingFields['region_id'] = null;
        }

        $incomingFields['territory_id']=strip_tags($request['territoryId']);
        if ($incomingFields['territory_id'] === 0) {
            $incomingFields['territory_id'] = null;
        }

        $outlet=Outlet::create($incomingFields);

        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['user_id']=auth()->id();
        $incomingFields['checkin_time']=strip_tags($request['time']);
        $incomingFields['checkin_time']=time();
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

public function setLocation($id,Request $request){

    $outlet=Outlet::find($id);
    
    $request->validate([
        //     'userId'=>'required',
        //     'time'=>'required',
        //     'lat'=>'required',
        //     'long'=>'required'
        'lat'=>'required|between:-90.000000000,90.000000000',
        'long'=>'required|between:-180.000000000,180.000000000',
        ]);
    
    
    $incomingFields['lat']=strip_tags($request['lat']);
    $incomingFields['long']=strip_tags($request['long']);
    
    $outlet->update($incomingFields);
    
    $setLocationStatus=array(
        "message" => "Set Location Successful",
        "status" => "success");

    return response()->json($setLocationStatus);

}
    //
    public function index(){
        $userId = auth()->id();
        $outlets = Outlet::where('user_id',$userId)->orderBy('id', 'DESC')->with('user')->get();
        return response()->json(['outlets'=>$outlets]);
    }

    public function followupOutlets(){
        $userId = auth()->id();
        $outlets = Outlet::where('user_id',$userId)->orderBy('id', 'DESC')->with('user')->get();

        $today = Carbon::today()->toDateString();

        $followupVisits = Followup::where('type', 'visit')
            ->where('user_id', $userId)
            ->whereDate('date', $today)
            ->with('outlet')
            ->get();

        // Extract the related outlets without a for loop:
        $outlets = $followupVisits->pluck('outlet')->unique('id');
        return response()->json(['outlets'=>$outlets]);
    }

        public function regionsTerritories(){
        
        // $regionId = auth()->user()->region_id;
        $regions = Region::orderBy('id', 'DESC')->get();
        // $territories = Territory::where('region_id',$regionId)
        $territories = Territory::orderBy('id', 'DESC')->get();
        return response()->json(compact('regions','territories'));
    }



}
