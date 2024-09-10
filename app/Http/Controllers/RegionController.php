<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    //
     //
     public function index() {
        $regions = Region::all();
        return view('region.index', ['regions'=>$regions]);
    }
    public function addRegion() {
        return view('region.create');
    }

    public function saveRegion(Request $request){
        $organization_id=auth()->user()->organization_id;
        $team_id=auth()->user()->team_id;
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255'
        ]);
        //return $incomingFields;

        
        
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['organization_id']=$organization_id;
        $incomingFields['team_id']=$team_id;
        //return $incomingFields['usertype'];

        Region::create($incomingFields);

        return redirect('/regions');
        
    }
    public function deleteRegion($id){
        $region = Region::find($id);
        $region->delete();
        return redirect('/regions');
    }
    public function showEditRegion($id){
        $region = Region::find($id);
        return view('region.edit',['region'=>$region]);
    }

    public function saveEditRegion($id, Request $request){
        
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
        ]);

        $incomingFields['name']=strip_tags($incomingFields['name']);

        $region=Region::find($id);

        $region->update($incomingFields);

        return redirect('/regions');
        
    }
}
