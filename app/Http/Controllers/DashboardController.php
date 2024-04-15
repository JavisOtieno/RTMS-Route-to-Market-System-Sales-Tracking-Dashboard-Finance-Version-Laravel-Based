<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Outlet;
use App\Models\Posaudit;
use App\Models\Competitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
