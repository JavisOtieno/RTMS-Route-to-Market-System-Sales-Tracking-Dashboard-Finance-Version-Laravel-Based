<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SignupController extends Controller
{
    //
    public function showSignup(){
        return view('signup');
    }

    public function doSignup(Request $request){
        
        $credentials = $request->validate([
            'organizationName'=>'required|string|max:255',
            'organizationPhone'=>'required|string|max:255',
            'organizationEmail'=>'required|string|max:255',
            'organizationRegNo'=>'required|string|max:255',
            'organizationKRAPin'=>'required|string|max:11',
            'name'=>'required|string|max:255',
            'phone'=>['required','min:10','string','max:255', new PhoneNumber],
            'email'=>'required|email|unique:users|max:255',
            //'password'=>'required|string|max:255|min:8|confirmed',
            'password' => ['required','string','max:255','min:8','confirmed',Password::min(8)->letters()->numbers()],
        ]);
        //return 'test';
        $incomingFields['name']=strip_tags($credentials['name']);
        $incomingFields['phone']=strip_tags($credentials['phone']);
        $incomingFields['usertype']='admin';
        $incomingFields['target_group_id']=0;
        $incomingFields['region_id']=0;
        $incomingFields['territory_id']=0;
        $incomingFields['image']='';
        $incomingFields['email']=strip_tags($credentials['email']);
        $incomingFields['password']=strip_tags($credentials['password']);

        $incomingFieldsOrganization['name']=strip_tags($credentials['organizationName']);
        $incomingFieldsOrganization['phone']=strip_tags($credentials['organizationPhone']);
        $incomingFieldsOrganization['email']=strip_tags($credentials['organizationEmail']);
        $incomingFieldsOrganization['registration_number']=strip_tags($credentials['organizationRegNo']);
        $incomingFieldsOrganization['kra_pin']=strip_tags($credentials['organizationKRAPin']);
        $incomingFieldsOrganization['status']='active';

        //return "hello";

        //return $incomingFields;
        try{

        $organization=Organization::create($incomingFieldsOrganization);

        //return $organization->id;

        $incomingFields['organization_id']=$organization->id;

        $user = User::create($incomingFields);
        
        // return $user->id;

        // Log the user in
        Auth::login($user);

        // Redirect the user to a dashboard or home page
        return redirect('dashboard')->with('success', 'User created successfully. You are now logged in.');

        } catch (\Exception $e) {
            // return back()->withInput()->with('error', 'An error occurred while creating the user. Please try again.');
            return redirect()->back()->withErrors([
                'specifyinputmaybe' => 'An error occurred while creating the user. Please try again.'
            ]);
        }

        

        //Initial design
        // if(User::count()==0){
        //     User::create($incomingFields);
        // }else{
        //     return redirect('signup')
        // ->withInput();
        // }

  

        
        
        // $credentials = $request->only('email', 'password');
        // return "we get here";
        // Auth::attempt($credentials);

        

        // $request->session()->regenerate();

        // return "hello";

        // return redirect('dashboard')
        // ->withSuccess('You have successfully registered & logged in!');

    }


}
