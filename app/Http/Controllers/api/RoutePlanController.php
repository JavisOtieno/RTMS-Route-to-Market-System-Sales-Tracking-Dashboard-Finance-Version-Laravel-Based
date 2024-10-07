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
        ->with('routeplanitems.outlet')->orderBy('id', 'DESC')->take(1)->get();
        return response()->json(['routeplan'=>$routeplan]);
    }

    public function index() {
        $userId = auth()->id();
        //$posaudits = Posaudit::all();
        //$posaudits = Posaudit::with('user','outlet','visit','posaudititems.product')->get();
        $routeplans = Routeplan::where('user_id',$userId)->with(['user' => function ($query) {
            $query->withTrashed();
        },'routeplanitems.outlet'])->orderBy('id', 'DESC')->get();
        return response()->json(['routeplans'=>$routeplans]);
    }

}
