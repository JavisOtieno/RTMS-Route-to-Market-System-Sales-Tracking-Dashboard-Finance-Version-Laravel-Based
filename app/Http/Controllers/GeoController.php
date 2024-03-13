<?php

namespace App\Http\Controllers;

use App\Models\Geo;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    //
    public function apiindex(){
        $geos = Geo::all();
        return response()->json(['geos'=>$geos]);
    }
    public function index() {
        $geos = Geo::all();
        return view('geos', ['geos'=>$geos]);
    }

}
