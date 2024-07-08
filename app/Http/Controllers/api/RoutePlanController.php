<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Routeplan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoutePlanController extends Controller
{
    //

    public function checkIfUserHasRoutePlanToday() {
        $userId = auth()->id();
        $routeplan = Routeplan::where('user_id',$userId)
        ->whereDate('date',  Carbon::today()->toDateString())
        ->with('routeplanitems.outlet')->orderBy('id', 'DESC')->get();
        return response()->json(['routeplan'=>$routeplan]);
    }
}
