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
        $competitors = Competitor::all();
        return view('competitors', ['competitors'=>$competitors]);
    }
    public function deleteCompetitiveanalysis($id){
        $competitiveAnalysis = Competitor::find($id);
        $competitiveAnalysis->delete();
        return redirect('/competitors');
    }

}
