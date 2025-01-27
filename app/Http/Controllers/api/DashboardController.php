<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Visit;
use App\Models\Outlet;
use App\Models\Clockin;
use App\Models\Product;
use App\Models\Clockout;
use App\Models\Feedback;
use App\Models\Posaudit;
use App\Models\SaleItem;
use App\Models\Competitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index(){
        //$salesCount = Sale::where('user_id',1)->count();
        $userId = auth()->id();


        //fetch today's sales
        $sales=Sale::where('user_id',$userId)
        ->whereDate('created_at',  Carbon::today()->toDateString())->get();

        $dailySalesTotal = 0;
        foreach($sales as $sale){
            $dailySalesTotal=$dailySalesTotal+$sale['value'];
        }
        
        $clockin=Clockin::where('user_id',$userId)->orderBy('id', 'desc')->take(1)->get();
        $clockout=Clockout::where('user_id',$userId)->orderBy('id', 'desc')->take(1)->get();
        $visit=Visit::where('user_id',$userId)->with('outlet')->orderBy('id', 'desc')->take(1)->get();

        if(count($clockin)>0){
        $clockinTime = strtotime($clockin[0]['created_at']);
        $clockinId = $clockin[0]['id'];
        }else{
        $clockinTime = 'undefined';
        $clockinId = 'undefined';
        }

        if(count($clockout)>0){
            $clockoutTime = strtotime($clockout[0]['created_at']);
            }else{
            $clockoutTime = 'undefined';
            }
        if(count($visit)>0)
        {
            //can be $visit[0]['checkin_time'] or created_at
        $checkinTime = strtotime($visit[0]['created_at']);
        $visitId = $visit[0]['id'];
        $outletId = $visit[0]['outlet_id'];
        $checkoutTime = $visit[0]['checkout_time'];
        $outletName = $visit[0]['outlet']['name'];
        $outletLat = $visit[0]['outlet']['lat'];
        $outletLong = $visit[0]['outlet']['long'];
        }
        else
        {
        $checkinTime = 'undefined';
        $outletId = 'undefined';
        $outletName = 'undefined';
        $visitId = 'undefined';
        $checkoutTime = 'undefined';
        $outletLat = 'undefined';
        $outletLong = 'undefined';
        }

        $currentTime = Carbon::now()->timestamp;

        $user=User::inOrganization()->where('id',$userId)->get();
        if($user[0]['target_group_id']==0 || $user[0]['targetgroup']==null){
            $currentTargets=0;
        }else{
            $user=User::inOrganization()->where('id',$userId)->with('targetgroup')->get();
            $currentTargets=$user[0]['targetgroup']['amount'];
        }
    
        $productsType = auth()->user()->organization->products;

        // $productstype = auth()->user()->organization->products;
        //products api on dashboard to show targets
        // if($productsType!=null && $productsType!='products'){
            $products = Product::orderBy('id', 'DESC')
            ->withSum(['saleitems as total_sales' => function ($query) {
                $query->whereMonth('created_at', now()->month)  // Filter by current month
                      ->whereYear('created_at', now()->year)   // Filter by current year
                      ->whereHas('sale', function ($saleQuery) {
                        $saleQuery->where('status', 'complete'); // Adjust the status as needed
                    })
                      ->select(DB::raw('SUM(value)'));         // Sum of 'value' column
            }], 'value')
            ->withSum(['saleitems as total_quantity' => function ($query) {
                $query->whereMonth('created_at', now()->month)  // Filter by current month
                      ->whereYear('created_at', now()->year)   // Filter by current year
                      ->whereHas('sale', function ($saleQuery) {
                        $saleQuery->where('status', 'complete'); // Adjust the status as needed
                    })
                      ->select(DB::raw('SUM(pieces)'));       // Sum of 'quantity' column
            }], 'pieces')
            ->take(4)
            ->get();
        // }else{
        //     $products =[];
        // }

        $salesCount = Sale::where('user_id',$userId)->count();
        $outletsCount = Outlet::where('user_id',$userId)->count();
        $feedbackCount = Feedback::where('user_id',$userId)->count();
        $posauditsCount = Posaudit::where('user_id',$userId)->count();
        $competitorsCount = Competitor::where('user_id',$userId)->count();
        $visitsCount = Visit::where('user_id',$userId)->count();

        $sales = Sale::where('user_id',$userId)->orderBy('id', 'desc')->take(5)->get();
        $outlets = Outlet::where('user_id',$userId)->orderBy('id', 'desc')->take(5)->get();
        $sales = Sale::where('user_id',$userId)->with('user','outlet','visit','saleitems.product')->orderBy('id', 'desc')->take(5)->get();
        //$saleItems = SaleItem::where('user_id',$userId)->with('product')->orderBy('id', 'desc')->take(5)->get();

        return response()->json( compact(
        'sales','outlets','salesCount','feedbackCount','productsType','products',
        'outletsCount','posauditsCount','visitsCount','competitorsCount','dailySalesTotal',
        'currentTargets','clockinTime','clockoutTime','checkinTime','checkoutTime', 'clockinId',
        'visitId','userId','outletId','outletName','outletLat','outletLong','currentTime'));

    }

}

