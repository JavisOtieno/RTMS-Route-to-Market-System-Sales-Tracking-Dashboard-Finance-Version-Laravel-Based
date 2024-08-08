<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //
    public function showProfile(){
        $id=auth()->user()->id;
        $user = User::inOrganization()->with('organization','region','targetgroup','territory')->find($id);
        return response()->json(['user'=>$user]);
    }
}
