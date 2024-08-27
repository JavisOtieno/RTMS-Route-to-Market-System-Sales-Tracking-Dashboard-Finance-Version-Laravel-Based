<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Visit;
use App\Models\Outlet;
use App\Models\Clockin;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
        //
        public function index() {
            //$visits = Visit::all();
            $visits = Visit::with(['user' => function ($query) {
                $query->withTrashed();
            },'outlet' => function ($query) {
                $query->withTrashed();
            }])->get();
            return view('visits', ['visits'=>$visits]);
        }

        public function showVisitsById($objectId,$object) {
            //$visits = Visit::all();
            $visits = Visit::with(['user' => function ($query) {
                $query->withTrashed();
            },'outlet' => function ($query) {
                $query->withTrashed();
            }])->where($object.'_id',$objectId)->get();
            return view('visits', ['visits'=>$visits]);
        }
        

        public function showEditVisit($id){
            //$visit = Visit::find($id);
            $visit=Visit::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get()->find($id);
            return view('edit-visit',['visit'=>$visit]);
        }

        public function checkout($id){
            //$visit = Visit::find($id);
            $visit=Visit::find($id);
            $outlet=Outlet::find($visit['outlet_id']);

            $incomingFields['checkout_latitude']=$outlet['lat'];
            $incomingFields['checkout_longitude']=$outlet['long'];
            $incomingFields['checkout_time']=now()->timestamp;
            $visit->update($incomingFields);
        
            return redirect('/visits');

        }

        public function showVisitsMap(){

            $visits = Visit::with(['user' => function ($query) {
                $query->withTrashed();
            }, 'outlet'])->get();

            $users = User::inOrganization()->get();
            $outlets = Outlet::all();
           
            //$users = User::inOrganization()->where('usertype','seller')->get();
            return view('visitsmap', compact('visits','users','outlets') );
        }

        public function showVisitsAnalytics(){

            $visits = Visit::with(['user' => function ($query) {
                $query->withTrashed();
            }, 'outlet'])->get();

            $users = User::inOrganization()->get();
            $outlets = Outlet::all();

            $visitsCount = Visit::all()->count();

            $visitsPerMonth= array();
            for ($i=0; $i<=11; $i++){
                $visitsPerMonth[$i] = Visit::whereMonth('created_at', date('m',strtotime('-'.$i.' month')))->count();
            }
            $visitsPerMonth =array_reverse($visitsPerMonth);

            $dates = [];
            $dayNames = [];
            $visitsPerDay = array();
            for ($i = 1; $i <= 7; $i++) {

                $date = now()->subDays($i);
                $dateString = $date->toDateString();
                $dayName = $date->format('l'); // Get the day name (e.g., 'Monday')
                
                $dates[] = $dateString;
                $dayNames[] = $dayName;

                $date = now()->subDays($i)->toDateString();
 

                $visitsPerDay[$date] = Visit::whereDate('created_at', $date)->count();
            }
            $visitsPerDay = array_reverse($visitsPerDay);
            $dates = array_reverse($dates);
            $dayNames = array_reverse($dayNames);

            


            $startOfMonth = date('Y-m-01 00:00:00'); // 1st day of the current month
            $today = date('Y-m-d 23:59:59'); // Current day
            $visitsThisMonth = Visit::whereBetween('created_at', [$startOfMonth, $today])->count();

            $startOfWeek = Carbon::now()->startOfWeek(); // Start of the week (Monday)
            $today = Carbon::now()->endOfDay(); // Current day
            $visitsThisWeek = Visit::whereBetween('created_at', [$startOfWeek, $today])->count();

            // Visits Today
            $startOfDay = Carbon::now()->startOfDay();
            $endOfDay = Carbon::now()->endOfDay();
            $visitsToday = Visit::whereBetween('created_at', [$startOfDay, $endOfDay])->count();


                    //get months Jan Feb Mar...Dec
            for ($i = 0; $i <= 11; $i++) {
                        $months[] = date("M", strtotime( date( 'Y-m-01' )." -$i months"));
                        }
                        //echo "Before";
                        //print_r($months);
                        //echo "After";
            $months=array_reverse($months);
           
            //$users = User::inOrganization()->where('usertype','seller')->get();
            return view('visitsanalytics', compact('visitsPerMonth','visits','users','outlets','months','visitsCount',
            'visitsThisMonth', 'visitsThisWeek','visitsToday','visitsPerDay','dates','dayNames') );
        }

        public function showRoutes() {
            //$clockins = Clockin::all();
            $clockins = Clockin::with(['user' => function ($query) {
                $query->withTrashed();
            },'clockout' => function ($query) {
                $query->withTrashed();
            },'visits.outlet'])->get();
    
            return view('visitsbyday', ['clockins'=>$clockins]);
        }

        public function showRoutesById($objectId) {
            //$clockins = Clockin::all();
            $clockins = Clockin::with(['user' => function ($query) {
                $query->withTrashed();
            },'clockout' => function ($query) {
                $query->withTrashed();
            },'visits.outlet'])->where('id',$objectId)
            ->get();
    
            return view('visitsbyday', ['clockins'=>$clockins]);
        }

        public function showEditVisitsByDay($id){
            $clockin = Clockin::with(['user' => function ($query) {
                $query->withTrashed();
            },'visits.outlet'])->get()->find($id);
            return view('edit-visitsbyday',compact('clockin'));
        }

        // public function showEditVisit(Request $request){
        //     $incomingFields=$request->validate([
        //         'id'=>'required|numeric|digits_between:1,11'
        //     ]);
        //     $visit = Visit::find($incomingFields['id']);
        //     return view('edit-visit',['visit'=>$visit]);
        // }

}
