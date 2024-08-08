<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    //
        //
        public function showOrganizationDetails(){
            $id=auth()->user()->organization_id;
            $organization = Organization::find($id);
            return response()->json(['organization'=>$organization]);
        }
}


