<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\PhoneNumber;
use App\Models\TargetGroup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    //
    public function apiindex(){
        //$sales = Sale::all();
        $users = User::all();
        return response()->json(['users'=>$users]);
    }
    public function index() {
        $users = User::with('targetgroup')->get();

        //return $users;
        //dd($sales);
        $targetgroups = TargetGroup::all();
        return view('users', ['users'=>$users, 'targetgroups'=>$targetgroups]);
    }
    public function showAddUsersToTargetGroups() {
        $users = User::all();
        $targetgroups = TargetGroup::all();
        //dd($sales);
        return view('add-users-to-target-group', compact('users','targetgroups') );
    }
    public function addUsersToTargetGroup(Request $request) {

        //return $request;
       
        $incomingFields=$request->validate([
            'target_group_id'=>'required|numeric|digits_between:1,11'
        ]);
    
        $selectedUsers = $request->input('users', []);
        

        // Process the selected items
        foreach ($selectedUsers as $selectedUserId) {
            $user = User::find($selectedUserId);
            $user->update($incomingFields);
           
            // Perform your processing here
            // For example, you can mark the item as processed, delete it, etc.
        }
        
        return redirect('/adduserstotargetgroups');
        //dd($sales);
        //return view('add-users-to-target-group', compact('users','targetgroups') );
    }
    
    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        return redirect('/users');
    }
    public function saveUser(Request $request){
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','min:10','string','max:255', new PhoneNumber],
            'usertype'=>'required|string|max:255',
            'email'=>'required|email|unique:users|max:255',
            //'password'=>'required|string|max:255|min:8|confirmed',
            'password' => ['required','string','max:255','min:8','confirmed',Password::min(8)->letters()->numbers()],
            'target_group_id'=>'required|numeric|digits_between:1,11'
        ]);
        //return $incomingFields;
        
        
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['usertype']=strip_tags($incomingFields['usertype']);
        $incomingFields['target_group_id']=strip_tags($incomingFields['target_group_id']);
        $incomingFields['email']=strip_tags($incomingFields['email']);
        $incomingFields['password']=strip_tags($incomingFields['password']);

        //return $incomingFields['usertype'];

        User::create($incomingFields);

        return redirect('/users');
        
    }

    public function addUser() {
        $targetgroups = TargetGroup::all();
        return view('add-user',['targetgroups'=>$targetgroups]);
    }

    public function showEditUser($id){
        $user = User::find($id);
        $targetgroups = TargetGroup::all();
        return view('edit-user',compact('user','targetgroups'));
    }

    public function saveEditUser($id, Request $request){
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','min:10','string','max:255', new PhoneNumber],
            'usertype'=>'required|string|max:255',
            // 'email'=>'required|email|max:255',
            // 'email'=>'required|email|unique:users|max:255',
            'email' => 'required|email|max:255|unique:user,email,' . $id,
            'target_group_id'=>'required|numeric|digits_between:1,11'
        ]);

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['usertype']=strip_tags($incomingFields['usertype']);
        $incomingFields['email']=strip_tags($incomingFields['email']);
        $incomingFields['target_group_id']=strip_tags($incomingFields['target_group_id']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);

        $user=User::find($id);

        $user->update($incomingFields);

        return redirect('/users');
        
    }

    public function showChangePassword($id){
        $user = User::find($id);
        return view('changepassword',['user'=>$user]);
    }

    public function saveChangePassword($id, Request $request){
        $incomingFields=$request->validate([
            'password'=>'required|confirmed|min:8'
        ]);

        $incomingFields['password']=strip_tags($incomingFields['password']);

        $user=User::find($id);

        $user->update($incomingFields);

        return redirect('/edituser/'.$id);
        
    }

    public function showProfile(){
        // if(Auth::check()) 
        // {
        // $user_id=Auth::user()->id;
        // }
        $user = User::find(auth()->user()->id);
        return view('edit-profile',['user'=>$user]);
    }

    

}
