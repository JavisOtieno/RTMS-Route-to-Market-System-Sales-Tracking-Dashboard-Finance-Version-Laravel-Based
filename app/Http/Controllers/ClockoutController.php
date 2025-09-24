<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Clockout;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClockoutController extends Controller
{
    //
        //
        public function apiindex(){
            $clockouts = Clockout::all();
            return response()->json(['clockouts'=>$clockouts]);
        }
        public function index() {
            //$clockouts = Clockout::all();
            $clockouts = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get();
            return view('clockout.index', ['clockouts'=>$clockouts]);
        }
                public function clockoutsYajra(Request $request)
        {
           
            $clockouts = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }],'channeltype','user.region','user.territory')->get();
            // return DataTables::of($clockouts)->make(true);
            $query = Clockout::select(
                'clockouts.*',
                // DB::raw("DATE_FORMAT(clockouts.created_at, '%d-%b-%Y') as date"),
                // DB::raw("DATE_FORMAT(clockouts.created_at, '%H:%i:%s') as time"),
                // DB::raw("DATE_FORMAT(FROM_UNIXTIME(clockouts.checkout_time), '%H:%i:%s') as checkout_time"),
                'regions.name as region_name',
                'territories.name as territory_name',
                // 'clusters.name as cluster_name',
                // 'channel_types.name as channel_type_name',
                // 'outlets.long as outlet_long',
                // 'outlets.lat as outlet_lat',
                'teams.name as team_name',
                'users.name as user_name',
                // 'outlets.name as outlet_name',
                // 'outlets.contact_person_name as contactpersonname',
                // 'outlets.phone as phone',
                
        )
            // ->leftJoin('outlets', 'outlets.id', '=', 'clockouts.outlet_id')
            // ->leftJoin('channel_types', 'channel_types.id', '=', 'outlets.channel_type_id')
            ->leftJoin('users', 'users.id', '=', 'clockouts.user_id')
            // // skjdjkjfjhsjkhdfks
            ->leftJoin('teams', 'teams.id', '=', 'clockouts.team_id')
            ->leftJoin('regions', 'regions.id', '=', 'users.region_id')
            ->leftJoin('territories', 'territories.id', '=', 'users.territory_id')
            // ->leftJoin('clusters', 'clusters.id', '=', 'users.cluster_id')
            ;
    

            if (!empty($request->from_time)) {
                $query->whereRaw("TIME(clockouts.created_at) >= ?", [$request->from_time]);
                }
                if (!empty($request->to_time)) {
                    $query->whereRaw("TIME(clockouts.created_at) <= ?", [$request->to_time]);
                }
            
                if (!empty($request->from_date)) {
                    $query->whereDate('clockouts.created_at', '>=', $request->from_date);
                }
            
                if (!empty($request->to_date)) {
                    $query->whereDate('clockouts.created_at', '<=', $request->to_date);
                }
    
            // $clockouts = $query->get();
            
            // ->join('outlets', 'outlets.id', '=', 'clockouts.outlet_id')
            // ->get();
            // return DataTables::of($clockouts)
            return DataTables::eloquent($query)
            ->addColumn('date', function ($clockout) {
                return $clockout->created_at->format('d-M-Y'); // Extract Date
            })     
            // ->addColumn('checkout_time', function ($clockout) {
            //     // return $clockout->checkout_time->format('d-M-Y'); // Extract Date
            //     if($clockout['checkout_time']=="")
            //         return 'Not Checked Out';
            //     else
            //         return date('H:i:s',$clockout['checkout_time']);
            // })
            // ->addColumn('duration', function ($clockout) {
            //     // return $clockout->checkout_time->format('d-M-Y'); // Extract Date
            //     if($clockout['checkout_time']=="")
            //         return gmdate("H:i:s", strtotime(0));
            //     else
            //         return gmdate("H:i:s", ($clockout['checkout_time']-strtotime($clockout['created_at'])));
            // })
            ->addColumn('time', function ($clockout) {
                return $clockout->created_at->format('H:i:s'); // Extract Time
            })
            
    
    
            ->rawColumns(['date', 'time']) // Ensure columns are not escaped
            ->make(true);
    
    
        }

        public function indexClockoutsYajra() {


            return view('clockout.indexyajra');
        }
        public function showClockoutsById($objectId,$object) {
            //$clockouts = Clockout::all();
            $clockouts = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }])->where($object.'_id',$objectId)->get();
            return view('clockout.index', ['clockouts'=>$clockouts]);
        }
                public function filterClockouts(Request $request) {
            //$visits = Visit::all();
            $query = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }]); // Eager load relationships for efficiency
    
            if ($request->user) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->user . '%');
                });
            }
        
            if ($request->from_date) {
                $query->whereDate('created_at', '>=', $request->from_date);
            }
        
            if ($request->to_date) {
                $query->whereDate('created_at', '<=', $request->to_date);
            }
            if ($request->from_time) {
                $query->whereRaw("TIME(created_at) >= ?", [$request->from_time]);
            }
            if ($request->to_time) {
                $query->whereRaw("TIME(created_at) <= ?", [$request->to_time]);
            }
                // Retrieve the current page from the request, defaulting to 1 if not set.
            $currentPage = $request->input('page', 1);
            
    
            // Explicitly pass the current page to the paginate() method.
            $clockouts = $query->orderBy('id', 'DESC')->paginate(500, ['*'], 'page', $currentPage);
    
            // $visits = $query->orderBy('id', 'DESC')->paginate(500);
            return response()->json(['clockouts'=>$clockouts]);
        }

        public function showEditClockout($id){
            //$clockout = Clockout::find($id);
            $clockout = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get()->find($id);
            return view('clockout.edit',['clockout'=>$clockout]);
        }

        public function showClockoutsMap(){
            $clockouts = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get();

           
            $users = User::inOrganization()->where('usertype','seller')->get();
           
            return view('clockout.map', compact('clockouts','users') );
        }

        public function deleteClockout($id){
            $clockout = Clockout::find($id);
            $clockout->delete();
            return redirect('/clockouts');
        }
                public function filterClockoutsAnalytics(Request $request) {
            //$visits = Visit::all();
            $query = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }]); // Eager load relationships for efficiency
    
            if ($request->user) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->user . '%');
                });
            }
            if ($request->from_time) {
            $query->whereRaw("TIME(created_at) >= ?", [$request->from_time]);
            }
            if ($request->to_time) {
                $query->whereRaw("TIME(created_at) <= ?", [$request->to_time]);
            }
        
            if ($request->from_date) {
                $query->whereDate('created_at', '>=', $request->from_date);
            }
        
            if ($request->to_date) {
                $query->whereDate('created_at', '<=', $request->to_date);
            }
            $baseQuery = $query;
                // Retrieve the current page from the request, defaulting to 1 if not set.
            // $currentPage = $request->input('page', 1);
    
            // Explicitly pass the current page to the paginate() method.
    
            $clockoutcount = $query->count();
            $clockoutcounttill16 = (clone $query)
            ->whereTime('created_at', '>=', '08:00:00')
            ->whereTime('created_at', '<', '16:00:00')
            ->count();
            
            $clockoutcounttill8 = (clone $query)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<', '08:00:00')
            ->count();
            // $clockoutcounttill16 = $query
            // ->whereTime('created_at', '>=', '08:00:00')
            // ->whereTime('created_at', '<', '16:00:00')
            // ->count();
    
            $clockoutcounttill24 = (clone $query)
            ->whereTime('created_at', '>=', '16:00:00')
            ->whereTime('created_at', '<', '24:00:00')
            ->count();
            // $clockoutfirst = (clone $query)->first();
            // $clockoutfirst =$clockoutfirst ? (date('H:i', strtotime($clockoutfirst['created_at']))) :'N/A';
            // $clockoutlast = (clone $query)->orderBy('created_at', 'desc')->first();
            // $clockoutlast =$clockoutlast ? (date('H:i', strtotime($clockoutlast['created_at']))) :'N/A';
            
            $clockoutfirst = (clone $query)
                ->orderByRaw("TIME(created_at) ASC")
                ->first();
            $clockoutfirst = $clockoutfirst ? date('H:i', strtotime($clockoutfirst['created_at'])) : 'N/A';
    
            $clockoutlast = (clone $query)
                ->orderByRaw("TIME(created_at) DESC")
                ->first();
            $clockoutlast = $clockoutlast ? date('H:i', strtotime($clockoutlast['created_at'])) : 'N/A';
                    // $clockoutfirst = date('H:i', strtotime($clockoutfirst['created_at']));

                    if ($request->from_date) {
                        $fromDate = Carbon::parse($request->from_date); // Assuming $request->from_date is a valid date string
                    }else{
                        $fromDate = Carbon::now()->startOfMonth(); // Defaults to the first day of the current month
                    }
                
                    if ($request->to_date) {
                        $toDate = Carbon::parse($request->to_date);
                    }else{
                        $toDate = Carbon::now(); // Get current date and time
                    }
            
                    $diffInDays = $fromDate->diffInDays($toDate)+1;
                    //include the date before
            
                    $datesFiltered = [];
                    $dayNamesFiltered = [];
                    $clockoutsPerDayFiltered = array();
                    // Loop through each day in the date range
                    for ($i = 0; $i < $diffInDays; $i++) {
                        // Create a copy of $toDate for each iteration, so the original $toDate is not modified
                        $currentDate = $toDate->copy()->subDays($i);
                        
                        // Get the date string and day name
                        $dateStringFiltered = $currentDate->toDateString();
                        $dayNameFiltered = $currentDate->format('l'); // Get the day name (e.g., 'Monday')
                        
                        // Store the date, day name, and clock-in count
                        $datesFiltered[] = $dateStringFiltered;
                        $dayNamesFiltered[] = $dayNameFiltered;
                    
                        // Get the count of clock-ins for the specific date
                        $clockoutsPerDayFiltered[$dateStringFiltered] = Clockout::whereDate('created_at', $dateStringFiltered)->count();
                    }
            
                    $clockoutsPerDayFiltered = array_reverse($clockoutsPerDayFiltered);
                    $datesFiltered = array_reverse($datesFiltered);
                    $dayNamesFiltered = array_reverse($dayNamesFiltered);
    
    
            // $visits = $query->orderBy('id', 'DESC')->paginate(500);
            return response()->json(compact('clockoutcount','clockoutcounttill8',
            'clockoutcounttill16','clockoutcounttill24','clockoutfirst','clockoutlast',
        'clockoutsPerDayFiltered','datesFiltered','dayNamesFiltered',));
        }

        public function showClockoutsAnalytics(){

            $clockouts = Clockout::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get();
    
            $users = User::inOrganization()->get();
            $outlets = Outlet::all();
    
            $clockoutsCount = Clockout::all()->count();
    
            $clockoutsPerMonth= array();
            for ($i=0; $i<=11; $i++){
                $clockoutsPerMonth[$i] = Clockout::whereMonth('created_at', date('m',strtotime('-'.$i.' month')))->count();
            }
            $clockoutsPerMonth =array_reverse($clockoutsPerMonth);
    
            $dates = [];
            $dayNames = [];
            $clockoutsPerDay = array();
            for ($i = 1; $i <= 7; $i++) {
    
                $date = now()->subDays($i);
                $dateString = $date->toDateString();
                $dayName = $date->format('l'); // Get the day name (e.g., 'Monday')
                
                $dates[] = $dateString;
                $dayNames[] = $dayName;
    
                $date = now()->subDays($i)->toDateString();
    
    
                $clockoutsPerDay[$date] = Clockout::whereDate('created_at', $date)->count();
            }
            $clockoutsPerDay = array_reverse($clockoutsPerDay);
            $dates = array_reverse($dates);
            $dayNames = array_reverse($dayNames);
            

            $datesFiltered = [];
            $dayNamesFiltered = [];
            $clockoutsPerDayFiltered = array();
            for ($i = 1; $i <= 1; $i++) {
    
                // ->subDays($i)
                $dateFiltered = now();
                $dateStringFiltered = $dateFiltered->toDateString();
                $dayNameFiltered = $dateFiltered->format('l'); // Get the day name (e.g., 'Monday')
                
                $datesFiltered[] = $dateStringFiltered;
                $dayNamesFiltered[] = $dayNameFiltered;
    
                // ->subDays($i)
                $dateFiltered = now()->toDateString();
    
    
                $clockoutsPerDayFiltered[$dateFiltered] = Clockout::whereDate('created_at', $dateFiltered)->count();
            }
            $clockoutsPerDayFiltered = array_reverse($clockoutsPerDayFiltered);
            $datesFiltered = array_reverse($datesFiltered);
            $dayNamesFiltered = array_reverse($dayNamesFiltered);    
            

    
            $startOfMonth = date('Y-m-01 00:00:00'); // 1st day of the current month
            $today = date('Y-m-d 23:59:59'); // Current day
            $clockoutsThisMonth = Clockout::whereBetween('created_at', [$startOfMonth, $today])->count();
    
            $startOfWeek = Carbon::now()->startOfWeek(); // Start of the week (Monday)
            $today = Carbon::now()->endOfDay(); // Current day
            $clockoutsThisWeek = Clockout::whereBetween('created_at', [$startOfWeek, $today])->count();
    
            // Clockouts Today
            $startOfDay = Carbon::now()->startOfDay();
            $endOfDay = Carbon::now()->endOfDay();
            $clockoutsToday = Clockout::whereBetween('created_at', [$startOfDay, $endOfDay])->count();
    
    
                    //get months Jan Feb Mar...Dec
            for ($i = 0; $i <= 11; $i++) {
                        $months[] = date("M", strtotime( date( 'Y-m-01' )." -$i months"));
                        }
                        //echo "Before";
                        //print_r($months);
                        //echo "After";
            $months=array_reverse($months);
    
            $clockoutcount = Clockout::whereDate('created_at', Carbon::today())->count();
            $clockoutcounttill8 = Clockout::whereDate('created_at', Carbon::today())
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<', '08:00:00')
            ->count();
            $clockoutcounttill16 = Clockout::whereDate('created_at', Carbon::today())
            ->whereTime('created_at', '>=', '08:00:00')
            ->whereTime('created_at', '<', '16:00:00')
            ->count();
            $clockoutcounttill24 = Clockout::whereDate('created_at', Carbon::today())
            ->whereTime('created_at', '>=', '16:00:00')
            ->whereTime('created_at', '<', '24:00:00')
            ->count();
            $clockoutfirst = Clockout::whereDate('created_at', Carbon::today())->first();
            $clockoutfirst =$clockoutfirst ? (date('H:i', strtotime($clockoutfirst['created_at']))) :'N/A';
            $clockoutlast =  Clockout::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->first();
            $clockoutlast =$clockoutlast ? (date('H:i', strtotime($clockoutlast['created_at']))) :'N/A';
            
    
           
            //$users = User::inOrganization()->where('usertype','seller')->get();
            return view('clockout.analytics', compact('clockoutsPerMonth','clockouts','users','outlets','months','clockoutsCount',
            'clockoutsThisMonth', 'clockoutsThisWeek','clockoutsToday','clockoutsPerDay','dates','dayNames',
            'clockoutcount','clockoutcounttill8','clockoutcounttill16','clockoutcounttill24','clockoutfirst','clockoutlast',
            'clockoutsPerDayFiltered','datesFiltered','dayNamesFiltered') );
        }


        // public function showEditClockout(Request $request){
        //     $incomingFields=$request->validate([
        //         'id'=>'required|numeric|digits_between:1,11'
        //     ]);
        //     $clockout = Clockout::find($incomingFields['id']);
        //     return view('edit-clockout',['clockout'=>$clockout]);
        // }

}
