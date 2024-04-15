<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function apiindex(){
        //$sales = Sale::all();
        $users = User::all();
        return response()->json(['users'=>$users]);
    }
    public function index() {
        $users = User::all();
        //dd($sales);
        return view('users', ['users'=>$users]);
    }
    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        return redirect('/users');
    }
    public function saveUser(Request $request){
       
        $incomingFields=$request->validate([
            'name'=>'required',
            'phone'=>'required',
            'usertype'=>'required',
            'email'=>'required',
            'password'=>'required',
            'targets'=>''
        ]);
        //return $incomingFields;
        
        
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['usertype']=strip_tags($incomingFields['usertype']);
        $incomingFields['targets']=strip_tags($incomingFields['targets']);
        $incomingFields['email']=strip_tags($incomingFields['email']);
        $incomingFields['password']=strip_tags($incomingFields['password']);

        //return $incomingFields['usertype'];

        User::create($incomingFields);

        return redirect('/users');
        
    }

    public function addUser() {
        return view('add-user');
    }

    public function showEditUser($id){
        $user = User::find($id);
        return view('edit-user',['user'=>$user]);
    }

    public function saveEditUser($id, Request $request){
        $incomingFields=$request->validate([
            'name'=>'required',
            'usertype'=>'required',
            'targets'=>'',
            'phone'=>'required',
            'email'=>'required',
        ]);

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['usertype']=strip_tags($incomingFields['usertype']);
        $incomingFields['email']=strip_tags($incomingFields['email']);
        $incomingFields['targets']=strip_tags($incomingFields['targets']);
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
            'password'=>'required|confirmed|min:6'
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
