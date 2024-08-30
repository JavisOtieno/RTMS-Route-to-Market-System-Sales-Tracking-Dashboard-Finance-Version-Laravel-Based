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
        $teamsellers = User::where('team_id',$id)->where('usertype','seller')->get();
        return view('team.edit',compact('team','teamsellers'));
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

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['description']=strip_tags($incomingFields['description']);
        // $incomingFields['organization_id']=$organization_id;

        $team=Team::find($id);

        $team->update($incomingFields);

        return redirect('/teams');
        
    }
}
