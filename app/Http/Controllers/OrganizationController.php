<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

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

}
