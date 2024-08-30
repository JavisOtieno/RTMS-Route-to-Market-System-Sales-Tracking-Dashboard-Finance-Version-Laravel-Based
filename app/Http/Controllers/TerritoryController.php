<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Territory;
use Illuminate\Http\Request;

class TerritoryController extends Controller
{
    public function index() {
        $territories = Territory::all();
        return view('territories', ['territories'=>$territories]);
    }
    public function addTerritory() {
        $regions = Region::all();
        return view('add-territory', ['regions'=>$regions]);
    }

    public function saveTerritory(Request $request){
        $organization_id=auth()->user()->organization_id;
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'regionId'=>'required|numeric|digits_between:1,20'
        ]);
        //return $incomingFields;
        
        
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['region_id']=strip_tags($incomingFields['regionId']);
        $incomingFields['organization_id']=$organization_id;
        //return $incomingFields['usertype'];

        Territory::create($incomingFields);

        return redirect('/territories');
        
    }
    public function deleteTerritory($id){
        $territory = Territory::find($id);
        $territory->delete();
        return redirect('/territories');
    }

    public function showEditTerritory($id){
        $territory = Territory::find($id);
        $regions = Region::all();
        return view('edit-territory',compact('territory','regions'));
    }

    public function saveEditTerritory($id, Request $request){
        // $organization_id=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'regionId'=>'required|numeric|digits_between:1,20'
        ]);

        $incomingFields['name']=strip_tags($incomingFields['name']);
        // $incomingFields['organization_id']=$organization_id;
        $incomingFields['region_id']=strip_tags($incomingFields['regionId']);

        $territory=Territory::find($id);

        $territory->update($incomingFields);

        return redirect('/territories');
        
    }
}
