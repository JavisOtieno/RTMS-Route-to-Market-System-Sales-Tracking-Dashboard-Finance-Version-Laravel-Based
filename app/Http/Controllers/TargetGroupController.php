<?php

namespace App\Http\Controllers;

use App\Models\TargetGroup;
use Illuminate\Http\Request;

class TargetGroupController extends Controller
{
    //
    public function index() {
        $targetgroups = TargetGroup::all();
        return view('targetgroups', ['targetgroups'=>$targetgroups]);
    }
    public function addTargetGroup() {
        return view('add-target-group');
    }

    public function saveTargetGroup(Request $request){
        $organization_id=auth()->user()->organization_id;
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'amount'=>'required|numeric|digits_between:1,11',
        ]);
        //return $incomingFields;
        
        
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['amount']=strip_tags($incomingFields['amount']);
        $incomingFields['organization_id']=$organization_id;
        //return $incomingFields['usertype'];

        TargetGroup::create($incomingFields);

        return redirect('/targetgroups');
        
    }
    public function deleteTargetGroup($id){
        $targetgroup = TargetGroup::find($id);
        $targetgroup->delete();
        return redirect('/targetgroups');
    }

    public function showEditTargetGroup($id){
        $targetgroup = TargetGroup::find($id);
        return view('edit-targetgroup',['targetgroup'=>$targetgroup]);
    }

    public function saveEditTargetGroup($id, Request $request){
        $organization_id=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'amount'=>'required|numeric|digits_between:1,11'
        ]);

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['amount']=strip_tags($incomingFields['amount']);
        $incomingFields['organization_id']=$organization_id;

        $targetgroup=TargetGroup::find($id);

        $targetgroup->update($incomingFields);

        return redirect('/targetgroups');
        
    }

}
