<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Clockin;
use Illuminate\Http\Request;

class ClockinController extends Controller
{
    //
    public function saveClockin(Request $request){

       
        $incomingFields=$request->validate([
            'userId'=>'required',
            'time'=>'required',
            'lat'=>'required',
            'long'=>'required'
        ]);
        
        $incomingFields['user_id']=strip_tags($incomingFields['userId']);
        $incomingFields['time']=strip_tags($incomingFields['time']);
        $incomingFields['lat']=strip_tags($incomingFields['lat']);
        $incomingFields['long']=strip_tags($incomingFields['long']);

        Clockin::create($incomingFields);

        return response()->json('Clockin Successful');
        
    }
}
