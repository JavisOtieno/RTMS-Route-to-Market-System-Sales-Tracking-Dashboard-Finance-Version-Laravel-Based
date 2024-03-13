<?php

namespace App\Http\Controllers;

use App\Models\Competitor;
use App\Models\Outlet;
use App\Models\Posaudit;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index() {
        $salesCount = Sale::all()->count();
        $outletsCount = Outlet::all()->count();
        $posauditsCount = Posaudit::all()->count();
        $competitorsCount = Competitor::all()->count();
        $sales = Sale::orderBy('id', 'desc')->take(5)->get();
        $outlets = Outlet::orderBy('id', 'desc')->take(5)->get();
        return view('dashboard', compact('sales','outlets','salesCount','outletsCount','posauditsCount','competitorsCount'));
    }
}
