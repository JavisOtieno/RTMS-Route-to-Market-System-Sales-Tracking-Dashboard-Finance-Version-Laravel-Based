<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function doLogin(Request $request){
        
        //if email is not valid it returns null json object
        $credentials = $request->validate([
            'email'=>'required|email|max:255',
            'password'=>'required|string|max:255|min:8'
        ]);
        //return 'test';
        
        if (Auth::attempt($credentials)) {

            $userId = auth()->user()->id;

            $user = User::inOrganization()->where('email',$request->email)->first();
            

            // $request->session()->regenerate();
            // return redirect()->intended('dashboard');
            if($user){

            $loginStatus=array(
                "message" => "Login Successful",
                "status" => "success",
                "test" => "test",
                'authToken' =>  $user->createToken('AuthToken')->plainTextToken,
                "userId"=>$userId);

            }else{
                $organization = Organization::find($user->organization_id);
                if($organization->status=="inactive"){
                    $message = "Invalid Organization";
                }else{
                    $message = "Login Failed";
                }
                $loginStatus=array(
                    "message" => $message,
                    "status" => "failed",
                    "test" => "test",
                    'authToken' =>  null,
                    "userId"=>null);

            }
    
            return response()->json($loginStatus);
            
        }else{
            $loginStatus=array(
                "message" => "Invalid Login Details",
                "status" => "failed");
        }


        return response()->json($loginStatus);
        
 
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');

    }
}
