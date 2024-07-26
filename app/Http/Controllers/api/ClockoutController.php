<?php

namespace App\Http\Controllers\api;

use App\Models\Clockout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ClockoutController extends Controller
{
    //
    public function saveClockout(Request $request){

       // $incomingFields=
        $request->validate([
        //     'userId'=>'required',
        //     'time'=>'required',
        //     'lat'=>'required',
        //     'long'=>'required'
        'userId'=>'required|numeric|digits_between:1,20|exists:users,id',
        'clockinId'=>'required|numeric|digits_between:1,20|exists:clockins,id',
        'time'=>'required|string|max:255',
        'lat'=>'required|between:-90.000000000,90.000000000',
        'long'=>'required|between:-180.000000000,180.000000000'
        ]);

        // $incomingFields=[];
        // $incomingFields['user_id']=strip_tags($request['userId']);
        // $incomingFields['time']=strip_tags($request['time']);
        // $incomingFields['lat']=strip_tags($request['lat']);
        // $incomingFields['long']=strip_tags($request['long']);

        
        // Clockout::create($incomingFields);

        //new clockout
        DB::beginTransaction();
        try {
            Clockout::create([
                'user_id' => $request['userId'],
                'clockin_id' => $request['clockinId'],
                'time' => $request['time'],
                'lat' => $request['lat'],
                'long' => $request['long'],
                'organization_id' => auth()->user()->organization_id

            ]);

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Clockout created successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 400,
                'message' => 'Clockout creation failed',
                'error' => $e->getMessage()
            ]);}



        $clockoutStatus=array(
            "message" => "Clockout Successful",
            "status" => "success");

        return response()->json($clockoutStatus);
        
    }

}
