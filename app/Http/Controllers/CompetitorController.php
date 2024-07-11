<?php

namespace App\Http\Controllers;

use App\Models\Competitor;
use Illuminate\Http\Request;

class CompetitorController extends Controller
{
    //
    public function apiindex(){
        $competitors = Competitor::all();
        return response()->json(['competitors'=>$competitors]);
    }
    public function index() {
        //$competitors = Competitor::all();
        $competitors = Competitor::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
        return view('competitors', ['competitors'=>$competitors]);
    }
    public function deleteCompetitiveanalysis($id){
        $competitiveAnalysis = Competitor::find($id);
        $competitiveAnalysis->delete();
        return redirect('/competitors');
    }
    public function showEditCompetitiveAnalysis($id){
        //$competitiveanalysis = Competitor::find($id);
        $competitiveanalysis = Competitor::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get()->find($id);
        return view('edit-competitiveanalysis',['competitiveanalysis'=>$competitiveanalysis]);
    }

    public function saveEditCompetitiveAnalysis($id, Request $request){

        // $organization_id=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'pricing' => 'required_without:brandVisibility',
            'brandVisibility' => 'required_without:pricing',
        ]);

        $incomingFields['pricing']=strip_tags($incomingFields['pricing']);
        $incomingFields['brand_visibility']=strip_tags($incomingFields['brandVisibility']);
        // $incomingFields['organization_id']=$organization_id;
        
        $competitiveAnalysis=Competitor::find($id);

        $competitiveAnalysis->update($incomingFields);

        return redirect('/competitors');
        
    }


    // public function showEditCompetitiveAnalysis(Request $request){
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $competitiveanalysis = Competitor::find($incomingFields['id']);
    //     return view('edit-competitiveanalysis',['competitiveanalysis'=>$competitiveanalysis]);
    // }

}
