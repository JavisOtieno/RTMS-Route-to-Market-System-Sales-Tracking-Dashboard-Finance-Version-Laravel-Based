<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Visit;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Feedback;
use App\Models\Posaudit;
use App\Models\SaleItem;
use Carbon\CarbonPeriod;
use App\Models\Competitor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index() {
        $salesCount = Sale::count(); 
        $visitsNumberCount = Visit::count();
        $productsNumberCount = Product::count();
        $feedbackCount = Feedback::count();
        $outletsCount = Outlet::count();
        $posauditsCount = Posaudit::count();
        $competitorsCount = Competitor::count();
        $sales = Sale::with(['user' => function ($query) {
            $query->withTrashed();
        },'outlet'])->orderBy('id', 'desc')->take(5)->get();
        $outlets = Outlet::orderBy('id', 'desc')->take(5)->get();
        $month=Carbon::now()->format('M');

        $topSellers=Sale::with(['user' => function ($query) {
            $query->withTrashed();
        }])->select('user_id', DB::raw('COUNT(user_id) as count'))
        ->groupBy('user_id')
        ->orderBy('count', 'desc')
        ->take(5)->get();

        // $topProducts=SaleItem::with('product')->select('product_id', DB::raw('COUNT(product_id) as count'))
        // ->groupBy('product_id')
        // ->orderBy('count', 'desc')
        // ->take(5)->get();

        $topProducts = Product::with('saleitems')
        ->select('products.id', 'products.name', 'products.description', 'products.sku', DB::raw('SUM(sale_items.pieces) as total_quantity'))
        ->join('sale_items', 'products.id', '=', 'sale_items.product_id')
        ->groupBy('products.id', 'products.name', 'products.description', 'products.sku')
        ->orderByDesc('total_quantity')
        ->take(5)
        ->get();


        $topSellerUserNames=[];
        $topSellerSalesCount=[];

        $topSellersGraph=Sale::with(['user' => function ($query) {
            $query->withTrashed();
        }])->select('user_id', DB::raw('COUNT(user_id) as count'))
        ->groupBy('user_id')
        ->orderBy('count', 'desc')
        ->take(10)->get();

        foreach($topSellersGraph as $topSeller){

            
            // $sellerName=$topSeller['user']['name'];
            $sellerName=$topSeller['user'] ? $topSeller['user']['name']  . ($topSeller['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User';
            $sellerNames=explode(' ',$sellerName);
            if(count($sellerNames)==1){
                array_push($topSellerUserNames,$sellerNames[0]);
            }else{
                array_push($topSellerUserNames,$sellerNames[0]."\n".$sellerNames[1]);
            }
            
            $sellerSalesCount=$topSeller['count'];
            array_push($topSellerSalesCount,$sellerSalesCount);

        }
                                
        
                             
        
        //$topSellers = User::inOrganization()::withCount('sales')->orderBy('sales_count', 'desc')->take(5)->get();
        //return $topSellers;

        $topOutlets=Sale::with(['outlet','user' => function ($query) {
            $query->withTrashed();
        }])->select('outlet_id', DB::raw('COUNT(outlet_id) as count'))
        ->groupBy('outlet_id')
        ->orderBy('count', 'desc')
        ->take(5)->get();

        $recentVisits=Visit::with('user','outlet')
        ->orderBy('id', 'desc')
        ->take(200)->get();

        // return $recentVisits;

        //$topOutlets = Outlet::withCount('sales')->orderBy('sales_count', 'desc')->take(5)->get();

        $salesPerMonth= array();
        for ($i=0; $i<=11; $i++){
            $salesPerMonth[$i] = Sale::
            whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m',strtotime('-'.$i.' month')))->count();
        }
        $salesPerMonth =array_reverse($salesPerMonth);



        //return $salesPerMonth;

        $days = CarbonPeriod::create(now()->subDays(6), now());
        $visitsCount=[];
        // $salesGraphCount=[];
        $outletsGraphCount=[];
        $productsGraphCount=[];
        // $salesWeekCount=0;
        $visitsWeekCount=0;
        $productsWeekCount=0;
        $outletsWeekCount=0;
        // foreach ($days as $day) {
        // // Your code ...
        // $visitscountperday=Visit::whereDate('created_at',$day)->count();
        // // $salescountperday=Sale::whereDate('created_at',$day)->count();
        // $outletscountperday=Outlet::whereDate('created_at',$day)->count();
        // $productscountperday=Product::whereDate('created_at',$day)->count();
        // //echo $day.' - '.$salescountperday.'//' ;
        // $visitsWeekCount=$visitsWeekCount+$visitscountperday;
        // // $salesWeekCount=$salesWeekCount+$salescountperday;
        // $outletsWeekCount=$outletsWeekCount+$outletscountperday;
        // $productsWeekCount=$productsWeekCount+$productscountperday;
        // array_push($visitsCount,$visitscountperday);
        // // array_push($salesGraphCount,$salescountperday);
        // array_push($outletsGraphCount,$outletscountperday);
        // array_push($productsGraphCount,$productscountperday);


        // }

        $salesGraphCount=[];
        $salesWeekCount=0;

        $periodStart = now()->subDays(6)->startOfDay();
        $periodEnd   = now()->endOfDay();
        $days = CarbonPeriod::create($periodStart, $periodEnd);

        // --- use Sale model (it already has org-scope) to fetch daily counts (1 query) ---
        $salesRows = Sale::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->whereBetween('created_at', [$periodStart, $periodEnd])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get()
            ->keyBy('date'); // keys: 'YYYY-MM-DD'

        // --- other tables: use their models (1 query each) ---
        $visitsRows = Visit::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->whereBetween('created_at', [$periodStart, $periodEnd])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get()
            ->keyBy('date');

        $outletsRows = Outlet::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->whereBetween('created_at', [$periodStart, $periodEnd])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get()
            ->keyBy('date');

        $productsRows = Product::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->whereBetween('created_at', [$periodStart, $periodEnd])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get()
            ->keyBy('date');

        foreach ($days as $day) {
            $d = $day->toDateString(); // 'YYYY-MM-DD'

            $vc = isset($visitsRows[$d])   ? (int)$visitsRows[$d]->total   : 0;
            $sc = isset($salesRows[$d])    ? (int)$salesRows[$d]->total    : 0;
            $oc = isset($outletsRows[$d])  ? (int)$outletsRows[$d]->total  : 0;
            $pc = isset($productsRows[$d]) ? (int)$productsRows[$d]->total : 0;

            $visitsCount[]       = $vc;
            $salesGraphCount[]   = $sc;
            $outletsGraphCount[] = $oc;
            $productsGraphCount[]= $pc;

            $visitsWeekCount  += $vc;
            $salesWeekCount   += $sc;
            $outletsWeekCount += $oc;
            $productsWeekCount+= $pc;
        }

        //get months Jan Feb Mar...Dec
        for ($i = 0; $i <= 11; $i++) {
                $months[] = date("M", strtotime( date( 'Y-m-01' )." -$i months"));
                }
                //echo "Before";
                //print_r($months);
                //echo "After";
        $months=array_reverse($months);
        //return $visitsCount;

            //return $salesGraphCount;
            //return $topSellerUserNames;

        return view('dashboard', compact('sales','outlets','salesCount','outletsCount',
        'posauditsCount','competitorsCount','salesPerMonth', 'visitsCount','salesGraphCount',
        'visitsWeekCount','salesWeekCount','visitsNumberCount','productsNumberCount',
        'feedbackCount','outletsGraphCount','productsGraphCount','outletsWeekCount',
        'productsWeekCount','months','topOutlets','topSellers','topSellerUserNames',
        'topSellerSalesCount','topProducts','recentVisits'
    ));

    }
}
