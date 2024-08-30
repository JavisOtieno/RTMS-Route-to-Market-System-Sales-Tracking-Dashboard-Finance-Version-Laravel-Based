<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TargetGroup;
use Illuminate\Http\Request;

class TargetGroupController extends CommonController
{
    //
    // test commit 2
    public function index() {
        $targetgroups = TargetGroup::all();
        return view('targetgroup.index', ['targetgroups'=>$targetgroups]);
    }
    public function addTargetGroup() {
        $teams = Team::all();
        return view('targetgroup.create',compact('teams'));
    }

    public function saveTargetGroup(Request $request){
        $organization_id=auth()->user()->organization_id;
        $team_id=$this->teamIdCheckAssign($request);
        // return $team_id;
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'amount'=>'required|numeric|digits_between:1,11',
        ]);
        //return $incomingFields;
        
        
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['amount']=strip_tags($incomingFields['amount']);
        $incomingFields['organization_id']=$organization_id;
        $incomingFields['team_id']=$team_id;
        //return $incomingFields['usertype'];
        // return $incomingFields;

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
        $teams = Team::all();
        return view('targetgroup.edit',compact('targetgroup','teams'));
    }

    // public function showEditTargetGroup(Request $request){
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $targetgroup = TargetGroup::find($incomingFields['id']);
    //     return view('edit-targetgroup',['targetgroup'=>$targetgroup]);
    // }

    public function saveEditTargetGroup($id, Request $request){
        $team_id=$this->teamIdCheckAssign($request);
        // $organization_id=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'amount'=>'required|numeric|digits_between:1,11'
        ]);

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['amount']=strip_tags($incomingFields['amount']);
        // $incomingFields['organization_id']=$organization_id;
        $incomingFields['team_id']=$team_id;

        $targetgroup=TargetGroup::find($id);

        $targetgroup->update($incomingFields);

        return redirect('/targetgroups');
        
    }

}
