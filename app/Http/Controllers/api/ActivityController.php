<?php

namespace App\Http\Controllers\api;

use App\Models\Sale;
use App\Models\Visit;
use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    //
    public function index(Request $request){
        //$sales = Sale::all();

        $request->validate([
            'visit_id' => 'required'
        ]);
        //get the outlet id
        $visitId = $request->input('visit_id');
        $visit=Visit::find($visitId)->with('outlet');
        $sales = Sale::where('visit_id', '=',30)->with('user','visit','outlet','saleitems.product')->get();
        //return $sales;

        return response()->json( compact('sales','visit'));
    }
}
