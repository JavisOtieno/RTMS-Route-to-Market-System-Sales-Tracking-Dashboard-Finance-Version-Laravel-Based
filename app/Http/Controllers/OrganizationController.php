<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\PhoneNumber;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class OrganizationController extends Controller
{
    //
    public function index() {
        // $outlets = Outlet::all();
        $organizations = Organization::all();
        return view('organization.index', ['organizations'=>$organizations]); 
    }
    public function addOrganization(){
        return view('organization.create');
    }
    public function saveOrganization(Request $request){
        $organization_id=auth()->user()->organization_id;
    
        $credentials = $request->validate([
            'organizationName'=>'required|string|max:255',
            'organizationPhone'=>'required|string|max:255',
            'organizationEmail'=>'required|string|max:255',
            'organizationRegNo'=>'required|string|max:255',
            'organizationKRAPin'=>'required|string|max:11',
            'organizationStatus'=>'required|string|max:255',
            'organizationProducts'=>'required|string|max:255',
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
        $incomingFieldsOrganization['status']=strip_tags($credentials['organizationStatus']);
        $incomingFieldsOrganization['products']=strip_tags($credentials['organizationProducts']);

        $organization=Organization::create($incomingFieldsOrganization);

        //return $organization->id;

        $incomingFields['organization_id']=$organization->id;

        $user = User::create($incomingFields);

        return redirect('/organizations');
        
    }

    public function showEditOrganization($id){
        $organization = Organization::find($id);
        return view('organization.edit',compact('organization'));
    }

    public function saveEditOrganization($id, Request $request){
        $organization_id=auth()->user()->organization_id;
    
        $credentials = $request->validate([
            'organizationName'=>'required|string|max:255',
            'organizationPhone'=>'required|string|max:255',
            'organizationEmail'=>'required|string|max:255',
            'organizationRegNo'=>'required|string|max:255',
            'organizationKRAPin'=>'required|string|max:11',
            'organizationStatus'=>'required|string|max:255',
  ]);
        //return 'test';


        $incomingFieldsOrganization['name']=strip_tags($credentials['organizationName']);
        $incomingFieldsOrganization['phone']=strip_tags($credentials['organizationPhone']);
        $incomingFieldsOrganization['email']=strip_tags($credentials['organizationEmail']);
        $incomingFieldsOrganization['registration_number']=strip_tags($credentials['organizationRegNo']);
        $incomingFieldsOrganization['kra_pin']=strip_tags($credentials['organizationKRAPin']);
        $incomingFieldsOrganization['status']=strip_tags($credentials['organizationStatus']);

        $organization=Organization::find($id);
        $organization->update($incomingFieldsOrganization);

        //return $organization->id;

        $incomingFields['organization_id']=$organization->id;

        return redirect('/organizations');
        
    }

}
