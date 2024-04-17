<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Competitor;
use Illuminate\Http\Request;

class CompetitorController extends Controller
{
    //

    public function saveCompetitorAnalysis(Request $request){

       
        // $incomingFields=$request->validate([
        //     'userId'=>'required',
        //     'time'=>'required',
        //     'lat'=>'required',
        //     'long'=>'required'
        // ]);

        //testt


        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['visit_id']=strip_tags($request['visitId']);
        $incomingFields['outlet_id']=strip_tags($request['outletId']);
        $incomingFields['brand_visibility']=strip_tags($request['brandVisibility']);
        $incomingFields['pricing']=strip_tags($request['pricing']);

        Competitor::create($incomingFields);

        $competitiveAnalysisStatus=array(
            "message" => "Competitive Analysis Saved Successfully",
            "status" => "success");

        return response()->json($competitiveAnalysisStatus);
        
    }

    public function index(){
        //$sales = Sale::all();
        $competitors = Competitor::with('user','outlet')->get();
        return response()->json(['competitors'=>$competitors]);
    }
}
