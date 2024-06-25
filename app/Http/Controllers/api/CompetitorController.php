<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Competitor;
use Illuminate\Http\Request;

class CompetitorController extends Controller
{
    //

    public function saveCompetitorAnalysis(Request $request){

       
        // $incomingFields=
         $request->validate([
            'userId'=>'required|numeric|digits_between:1,11',
            'visitId'=>'required|numeric|digits_between:1,11',
            'outletId'=>'required|numeric|digits_between:1,11',
            'pricing' => 'required_without:brandVisibility',
            'brandVisibility' => 'required_without:pricing',
         ]);

        //testt


        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['visit_id']=strip_tags($request['visitId']);
        $incomingFields['outlet_id']=strip_tags($request['outletId']);
        $incomingFields['brand_visibility']=strip_tags($request['brandVisibility']);
        $incomingFields['pricing']=strip_tags($request['pricing']);
        $incomingFields['organization_id']=auth()->user()->organization_id;


        Competitor::create($incomingFields);

        $competitiveAnalysisStatus=array(
            "message" => "Competitive Analysis Saved Successfully",
            "status" => "success");

        return response()->json($competitiveAnalysisStatus);
        
    }

    public function index(){
        //$sales = Sale::all();
        $userId = auth()->id();
        $competitors = Competitor::where('user_id',$userId)->orderBy('id', 'DESC')->with('user','outlet')->get();
        return response()->json(['competitors'=>$competitors]);
    }
    public function visitCompetitiveAnalysis(Request $request){
        //$sales = Sale::all();
        $incomingFields=$request->validate([
            'visitId'=>'required',
        ]);
        $visitId=strip_tags($request['visitId']);

        $userId = auth()->id();
        $competitors = Competitor::where('visit_id', $visitId)->where('user_id',$userId)->with('user','visit','outlet')->get();
        return response()->json(['competitors'=>$competitors]);
    }
}
