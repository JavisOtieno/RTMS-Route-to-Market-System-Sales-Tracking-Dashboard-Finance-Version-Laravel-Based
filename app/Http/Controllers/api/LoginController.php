<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function doLogin(Request $request){
        
        //if email is not valid it returns null json object
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        //return 'test';
        
        if (Auth::attempt($credentials)) {

            $userId = auth()->user()->id;

            $user = User::where('email',$request->email)->first();
            

            // $request->session()->regenerate();
            // return redirect()->intended('dashboard');

            $loginStatus=array(
                "message" => "Login Successful",
                "status" => "success",
                'authToken' =>  $user->createToken('AuthToken')->plainTextToken,
                "userId"=>$userId);
    
            return response()->json($loginStatus);
            
        }

        $loginStatus=array(
            "message" => "Login Failed",
            "status" => "failed");

        return response()->json($loginStatus);
        
 
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');

    }
}
