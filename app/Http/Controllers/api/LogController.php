<?php

namespace App\Http\Controllers\api;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function addlog(Request $request){

    $incomingFieldsLog=[];
    $checkinLat=strip_tags($request['checkinLat']);
    $checkinLong=strip_tags($request['checkinLong']);
    $outletLat=strip_tags($request['outletLat']);
    $outletLong=strip_tags($request['outletLong']);


    $incomingFieldsLog['log']=" OutletLat: ".$outletLat." OutletLong: ".$outletLong
    ." CheckinLat: ".$checkinLat." CheckinLong: ".$checkinLong;
    

    Log::create($incomingFieldsLog);

    }

}
