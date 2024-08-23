<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use App\Models\Routeplan;
use App\Models\RouteplanItem;
use Illuminate\Http\Request;

class RouteplanController extends Controller
{
    //

    public function index() {
        //$posaudits = Posaudit::all();
        //$posaudits = Posaudit::with('user','outlet','visit','posaudititems.product')->get();
        $routeplans = Routeplan::with(['user' => function ($query) {
            $query->withTrashed();
        },'routeplanitems.outlet'])->get();
        return view('routeplans', ['routeplans'=>$routeplans]);
    }

    public function createRoutePlan() {
        $outlets = Outlet::all();
        $users = User::inOrganization()->where('usertype','seller')->get();
        $firstuserid = $users[0]["id"];
        $outlets = Outlet::with(['user' => function ($query) {
            $query->withTrashed();
        }])->where("user_id",$firstuserid)->get();
        return view('createrouteplan', compact('users','outlets','firstuserid'));
    }

    public function updateOutletsCreateRoutePlan($id){
        $outlets = Outlet::with(['user' => function ($query) {
            $query->withTrashed();
        }])->where("user_id",$id)->get();
        return response()->json(['outlets'=>$outlets]);
    }

    public function showEditRoutePlan($id){
        //$posaudit = Posaudit::find($id);
        $routeplan = Routeplan::with(['user' => function ($query) {
            $query->withTrashed();
        },
        'routeplanitems' => function ($query) {
        $query->with(['outlet' 
        // => function ($query) {
        //     $query->withTrashed();
        // }
        ]);
        }
        ])->get()->find($id);
        return view('edit-routeplan',['routeplan'=>$routeplan]);
    }



    public function pushOutletsToRoutePlan(Request $request) {
       
        $incomingFields=$request->validate([
            'user_id'=>'required|numeric|digits_between:1,11',
            'outletcheckboxes' => 'required|array|min:1',
        ],[
            'outletcheckboxes.required' => 'You must select at least one outlet.',
            'outletcheckboxes.min' => 'You must select at least one outlet.',
        ]);
        $user_id=$incomingFields['user_id'];

        $selectedOutlets = $request->input('outletcheckboxes', []);
        
        // Process the selected items
        $outletArray=[];
        $outletString = "";
        foreach ($selectedOutlets as $selectedOutletId) {
            $outlet = Outlet::find($selectedOutletId);
            array_push($outletArray,$outlet);
            if($outletString==""){
                $outletString = $outletString.$outlet['id'];
            }else{
                $outletString = $outletString.",".$outlet['id'];
            }
            
            //$outlet->update($incomingFields);
           
            // Perform your processing here
            // For example, you can mark the item as processed, delete it, etc.
        }

        //return $outletString;
        
        // return redirect('/createrouteplanstage2');
        // selectedOutlets
        // outletArray
        return view('createrouteplanstage2', compact('outletString','outletArray','user_id'));
 
    }

    public function saveEditRoutePlan($id,Request $request){
        $incomingFields=$request->validate([
            'date'=>'required|string|max:255',
        ]);
        $incomingFields['date']=strip_tags($incomingFields['date']);

        $routePlan=Routeplan::find($id);

        $routePlan->update($incomingFields);

        return redirect('/routeplans');

    }

    public function debugToRoutePlan(){
        $outletArray=[];
        $outletString = "";
        return view('createrouteplanstage2', compact('outletString','outletArray'));

    }

    public function saveRoutePlan(Request $request){

        // required not necessary
        //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
       
        $incomingFields=$request->validate([
            'name'=>'nullable|string|max:255',
            'date'=>'required|string|max:255',
            'outletIds'=>'required|string',
            'user_id'=>'required|numeric|digits_between:1,11'
        ]);

        if($incomingFields['name']==""){
            $incomingFields['name']="Routeplan-".time();
        }

        
        $organization_id=auth()->user()->organization_id;
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['date']=strip_tags($incomingFields['date']);
        $incomingFields['user_id']=strip_tags($incomingFields['user_id']);
        $incomingFields['organization_id']=$organization_id;
        //$incomingFields['image']=strip_tags($incomingFields['image']);

        

        if(strlen($incomingFields['outletIds'])>0){

            $routePlan=Routeplan::create($incomingFields);
            $routePlanId=$routePlan->id;
    
            $incomingFieldsRoutePlanItem['routeplan_id']=$routePlanId;
    
            
            //return $incomingFields['products'];
            $routePlanArray= explode(',',$incomingFields['outletIds']);
            //return json_encode($posAuditArray);
    
            foreach ($routePlanArray as $routeOutletId) {
                # code...
                
                $incomingFieldsRoutePlanItem['outlet_id']=$routeOutletId;

                $routePlanItem=RouteplanItem::create($incomingFieldsRoutePlanItem);
    
            }
    
            //Posaudit::create($incomingFields);
    
            $routePlanStatus=array(
                "message" => "Route Plan Added Successful",
                "routePlanId" => $routePlanId,
                "status" => "success"
            );
    
            }else{ 
                return redirect()->back()
                             ->withErrors("Route Plan Outlets Missing")
                             ->withInput();
                $routePlanStatus=array(
                    "message" => "Route Plan Outlets Missing",
                    "status" => "failed");
            }

        return redirect('/routeplans');
        
    }

    public function deleteRoutePlan($id){
        $routeplan = Routeplan::find($id);
        $routeplan->delete();
        return redirect('/routeplans');
    }



    




}
