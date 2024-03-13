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
            'email'=>'required',
            'password'=>'required'
        ]);
        //return $incomingFields;
        
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['email']=strip_tags($incomingFields['email']);
        $incomingFields['password']=strip_tags($incomingFields['password']);

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
            'phone'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['email']=strip_tags($incomingFields['email']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['password']=strip_tags($incomingFields['password']);

        $user=User::find($id);

        $user->update($incomingFields);

        return redirect('/users');
        
    }
    public function displayLoginPage(){
        return view('login');
    }
}
