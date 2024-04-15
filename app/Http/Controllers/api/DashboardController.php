<?php

namespace App\Http\Controllers\api;

use App\Models\Sale;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Feedback;
use App\Models\Posaudit;
use App\Models\Competitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clockin;
use App\Models\Clockout;
use App\Models\Visit;

class DashboardController extends Controller
{
    //
    public function index(){
        //$salesCount = Sale::where('user_id',1)->count();
        $sales=Sale::all();
        $dailySalesTotal = 0;
        foreach($sales as $sale){
            $dailySalesTotal=$dailySalesTotal+$sale['product']['price']*$sale['pieces'];
        }

        
        $clockin=Clockin::where('user_id',1)->orderBy('id', 'desc')->take(1)->get();
        $clockout=Clockout::where('user_id',1)->orderBy('id', 'desc')->take(1)->get();
        $visit=Visit::where('user_id',1)->orderBy('id', 'desc')->take(1)->get();
        if(count($clockin)>0){
        $clockinTime = $clockin[0]['time'];
        }else{
        $clockinTime = 'undefined';
        }
        if(count($clockout)>0){
            $clockoutTime = $clockout[0]['time'];
            }else{
            $clockoutTime = 'undefined';
            }
        if(count($visit)>0){
        $checkinTime = $visit[0]['checkin_time'];
        $visitId = $visit[0]['id'];
        $outletId = $visit[0]['outlet_id'];
        $checkoutTime = $visit[0]['checkout_time'];
        }else{
        $checkinTime = 'undefined';
        $visitId = 'undefined';
        $checkoutTime = 'undefined';
        }

        $user=User::where('id',1)->get();
        $currentTargets=$user[0]['targets'];
        $userId=$user[0]['id'];
        $salesCount = Sale::all()->count();
        $outletsCount = Outlet::all()->count();
        $feedbackCount = Feedback::all()->count();
        $posauditsCount = Posaudit::all()->count();
        $competitorsCount = Competitor::all()->count();

        $sales = Sale::orderBy('id', 'desc')->take(5)->get();
        $outlets = Outlet::orderBy('id', 'desc')->take(5)->get();
        $sales = Sale::with('user','outlet','product')->orderBy('id', 'desc')->take(5)->get();

        return response()->json( compact('sales','outlets','salesCount','feedbackCount',
        'outletsCount','posauditsCount','competitorsCount','dailySalesTotal',
        'currentTargets','clockinTime','clockoutTime','checkinTime','checkoutTime',
        'visitId','userId','outletId'));

    }
}

