<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //
    public function showProfile($id){
        $user = User::find($id);
        return response()->json(['user'=>$user]);
    }
}
