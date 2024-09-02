<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //
        //
    // test commit 2
    public function index() {
        $teams = Team::all();
        return view('team.index', compact('teams'));
    }
    public function addTeam() {
        return view('team.create');
    }

    public function saveTeam(Request $request){
        $organization_id=auth()->user()->organization_id;
        
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'description'=>'required|string|max:1048576',
        ]);
        //return $incomingFields;
        
        
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['description']=strip_tags($incomingFields['description']);
        $incomingFields['organization_id']=$organization_id;
        //return $incomingFields['usertype'];

        $team= Team::create($incomingFields);

        return redirect('/editteam/'.$team->id);
        
    }
    public function deleteTeam($id){
        $team = Team::find($id);
        $team->delete();
        return redirect('/teams');
    }

    public function showEditTeam($id){

        $team = Team::find($id);
        $teamleads = User::where('usertype','teamlead')->get();
        $selectedteamleadarray = User::where('team_id',$id)->where('usertype','teamlead')->get();
        if(count($selectedteamleadarray)>0){
            $selectedteamlead=$selectedteamleadarray[0];
        }else{
            $selectedteamlead=null;
        }

        // return $selectedteamlead;
        $teamsellers = User::where('team_id',$id)->where('usertype','seller')->get();
        return view('team.edit',compact('team','teamsellers','teamleads','selectedteamlead'));
    }

    // public function showEditTargetGroup(Request $request){
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $targetgroup = TargetGroup::find($incomingFields['id']);
    //     return view('edit-targetgroup',['targetgroup'=>$targetgroup]);
    // }

public function saveEditTeam($id, Request $request){
        // $organization_id=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'description'=>'required|string|max:1048576'
        ]);

        $teamLeadId=$request->validate([
            'teamlead_id'=>'required|numeric|digits_between:1,20',
        ]);
        if($teamLeadId['teamlead_id']==0){
            $teamLeadId = null;
        }else{
            //remove previous team lead
            $selectedteamleadarray = User::where('team_id',$id)->where('usertype','teamlead')->get();
            if(count($selectedteamleadarray)>0){
                $incomingFieldsTeamLead['team_id']=null;
                $selectedteamlead=$selectedteamleadarray[0];
                $selectedteamlead->update($incomingFieldsTeamLead);
            }
            
            //make new team lead
            $teamLeadId = $teamLeadId['teamlead_id'];
            $incomingFieldsTeamLead['team_id']=$id;
            $teamLead = User::find($teamLeadId);
            $teamLead->update($incomingFieldsTeamLead);
  

        }
        //return $teamLead;

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['description']=strip_tags($incomingFields['description']);
        
        // $incomingFields['organization_id']=$organization_id;

        $team=Team::find($id);

        $team->update($incomingFields);

        return redirect('/teams');
        
    }
}
