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
    public function makesale(Request $request){

       
        // $incomingFields=$request->validate([
        //     'userId'=>'required',
        //     'time'=>'required',
        //     'lat'=>'required',
        //     'long'=>'required'
        // ]);

        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['outlet_id']=strip_tags($request['outletId']);
        $incomingFields['product_id']=strip_tags($request['productId']);
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['pieces']=strip_tags($request['pieces']);

        
        Sale::create($incomingFields);
        
        $saleStatus=array(
                "message" => "Sale Successful",
                "status" => "success");
        

        return response()->json($saleStatus);

}

}
