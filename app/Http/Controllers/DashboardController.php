<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Visit;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Posaudit;
use Carbon\CarbonPeriod;
use App\Models\Competitor;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index() {
        $salesCount = Sale::all()->count();
        $visitsNumberCount = Visit::all()->count();
        $productsNumberCount = Product::all()->count();
        $feedbackCount = Feedback::all()->count();
        $outletsCount = Outlet::all()->count();
        $posauditsCount = Posaudit::all()->count();
        $competitorsCount = Competitor::all()->count();
        $sales = Sale::orderBy('id', 'desc')->take(5)->get();
        $outlets = Outlet::orderBy('id', 'desc')->take(5)->get();
        $month=Carbon::now()->format('M');

        $salesPerMonth= array();
        for ($i=0; $i<=11; $i++){
            $salesPerMonth[$i] = Sale::whereMonth('created_at', date('m',strtotime('-'.$i.' month')))->count();
        }
        $salesPerMonth =array_reverse($salesPerMonth);


        //return $salesPerMonth;

        $days = CarbonPeriod::create(now()->subDays(6), now());
        $visitsCount=[];
        $visitsWeekCount=0;
        $salesGraphCount=[];
        $outletsGraphCount=[];
        $productsGraphCount=[];
        $salesWeekCount=0;
        foreach ($days as $day) {
        // Your code ...
        $visitscountperday=Visit::whereDate('created_at',$day)->count();
        $salescountperday=Sale::whereDate('created_at',$day)->count();
        $outletscountperday=Outlet::whereDate('created_at',$day)->count();
        $productscountperday=Product::whereDate('created_at',$day)->count();
        //echo $day.' - '.$salescountperday.'//' ;
        $visitsWeekCount=$visitsWeekCount+$visitscountperday;
        $salesWeekCount=$salesWeekCount+$salescountperday;
        array_push($visitsCount,$visitscountperday);
        array_push($salesGraphCount,$salescountperday);
        array_push($outletsGraphCount,$outletscountperday);
        array_push($productsGraphCount,$productscountperday);
        }
        //return $visitsCount;

            //return $salesGraphCount;

        return view('dashboard', compact('sales','outlets','salesCount','outletsCount',
        'posauditsCount','competitorsCount','salesPerMonth', 'visitsCount','salesGraphCount',
        'visitsWeekCount','salesWeekCount','visitsNumberCount','productsNumberCount',
        'feedbackCount','outletsGraphCount','productsGraphCount'));

    }
}
