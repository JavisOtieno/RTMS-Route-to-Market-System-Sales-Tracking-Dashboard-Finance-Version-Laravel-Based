<?php

namespace App\Http\Controllers\api;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    //
    public function index(){
        //$sales = Sale::all();
        $sales = Sale::with('user','outlet','product')->get();
        return response()->json(['sales'=>$sales]);
    }
}
