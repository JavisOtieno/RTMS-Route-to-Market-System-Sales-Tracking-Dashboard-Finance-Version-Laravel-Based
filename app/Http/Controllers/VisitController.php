<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Visit;
use App\Models\Outlet;
use App\Models\Clockin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
            },
            'outlet.region',        // <--- eager load region
            'outlet.territory',     // <--- eager load territory
            'team', 
            ])->get();
            return view('visit.index', ['visits'=>$visits]);
        }
        public function indexYajra() {
            return view('visit.indexyajra');
        }

        public function visitsYajra(Request $request)
        {

            $visits = Visit::with(['user' => function ($query) {
                $query->withTrashed();
            }],'user.region','user.territory')->get();
            // return DataTables::of($visits)->make(true);
            $query = Visit::select(
                'visits.*',
                // DB::raw("DATE_FORMAT(visits.created_at, '%d-%b-%Y') as date"),
                // DB::raw("DATE_FORMAT(visits.created_at, '%H:%i:%s') as time"),
                // DB::raw("DATE_FORMAT(FROM_UNIXTIME(visits.checkout_time), '%H:%i:%s') as checkout_time"),
                'regions.name as region_name',
                'territories.name as territory_name',
                // 'clusters.name as cluster_name',
                // 'channel_types.name as channel_type_name',
                'outlets.long as outlet_long',
                'outlets.lat as outlet_lat',
                'teams.name as team_name',
                'users.name as user_name',
                'outlets.name as outlet_name',
                'outlets.contact_person_name as contactpersonname',
                'outlets.phone as phone',

            )
            ->leftJoin('outlets', 'outlets.id', '=', 'visits.outlet_id')
            // ->leftJoin('channel_types', 'channel_types.id', '=', 'outlets.channel_type_id')
            ->leftJoin('users', 'users.id', '=', 'visits.user_id')
            // skjdjkjfjhsjkhdfks
            ->leftJoin('teams', 'teams.id', '=', 'visits.team_id')
            ->leftJoin('regions', 'regions.id', '=', 'users.region_id')
            ->leftJoin('territories', 'territories.id', '=', 'users.territory_id');
            // ->leftJoin('clusters', 'clusters.id', '=', 'users.cluster_id');

            $toDate = \Carbon\Carbon::parse($request->to_date)->endOfDay();

            // if ($request->has('from_date') && $request->has('to_date')) {
            //     if(!empty($request->from_date) && !empty($request->to_date)){
            //         $query->whereBetween('outlets.created_at', [$request->from_date, $toDate]);
            //     }else if(!empty($request->from_date)){
            //         $query->where('outlets.created_at', '>=', $request->from_date);
            //     }
            //     else if(!empty($request->to_date)){
            //         $query->where('outlets.created_at', '<=', $toDate);
            //     }

            // }
            if (!empty($request->from_checkouttime)) {
                $query->whereRaw("visits.checkouttimeexact >= ?", [$request->from_checkouttime]);
                }
                if (!empty($request->to_checkouttime)) {
                    $query->whereRaw("visits.checkouttimeexact <= ?", [$request->to_checkouttime]);
                }
            if (!empty($request->from_time)) {
                $query->whereRaw("TIME(visits.created_at) >= ?", [$request->from_time]);
                }
                if (!empty($request->to_time)) {
                    $query->whereRaw("TIME(visits.created_at) <= ?", [$request->to_time]);
                }
            if (!empty($request->from_duration)) {
                $query->whereRaw("TIME(visits.duration) >= ?", [$request->from_duration]);
                }
                if (!empty($request->to_duration)) {
                    $query->whereRaw("TIME(visits.duration) <= ?", [$request->to_duration]);
                }

                if (!empty($request->from_date)) {
                    $query->whereDate('visits.created_at', '>=', $request->from_date);
                }

                if (!empty($request->to_date)) {
                    $query->whereDate('visits.created_at', '<=', $request->to_date);
                }
            $visits = $query->get();

            // ->join('outlets', 'outlets.id', '=', 'visits.outlet_id')
            // ->get();
            return DataTables::of($visits)
            ->addColumn('date', function ($visit) {
                return $visit->created_at->format('d-M-Y'); // Extract Date
            })
            // ->addColumn('checkout_time', function ($visit) {
            //     // return $visit->checkout_time->format('d-M-Y'); // Extract Date
            //     if($visit['checkout_time']=="")
            //         return 'Not Checked Out';
            //     else
            //         return date('H:i:s',$visit['checkout_time']);
            // })
            // ->addColumn('duration', function ($visit) {
            //     // return $visit->checkout_time->format('d-M-Y'); // Extract Date
            //     if($visit['checkout_time']=="")
            //         return gmdate("H:i:s", strtotime(0));
            //     else
            //         return gmdate("H:i:s", ($visit['checkout_time']-strtotime($visit['created_at'])));
            // })
            ->addColumn('time', function ($visit) {
                return $visit->created_at->format('H:i:s'); // Extract Time
            })

            //  ->addColumn('outlet_lat', function ($row) {
            //     return $row->outlet ? $row->outlet->lat : 'N/A';
            // })
            // ->addColumn('outletname', function ($row) {
            //     return $row->outlet ? $row->outlet->name : 'N/A';
            // })

            // ->addColumn('sellername', function ($row) {
            //     return $row->user ? $row->user->name : 'N/A';
            // })
            // ->addColumn('contactpersonname', function ($row) {
            //     return $row->outlet ? $row->outlet->contact_person_name : 'N/A';
            // })
            // ->addColumn('phone', function ($row) {
            //     return $row->outlet ? $row->outlet->phone : 'N/A';
            // })
            // ->addColumn('teamname', function ($row) {
            //     return $row->team ? $row->team->name : 'N/A';
            // })
            // ->addColumn('regionname', function ($row) {
            //     return $row->user? ($row->user->cluster!=null ? $row->user->cluster->name : 'N/A') : 'N/A';
            // //     return 'N/A';
            // })
            // ->addColumn('territoryname', function ($row) {
            //     // return $row->user->territory ? $row->user->territory->name : 'N/A';
            //     return 'N/A';
            // })
            // ->addColumn('clustername', function ($row) {
            //     // return $row->user? ($row->user->cluster!=null ? $row->user->cluster->name : 'N/A') : 'N/A';
            //     // $cluster_id=$row->user->cluster_id;
            //     // $cluster = Cluster::find($cluster_id);
            //     // return $cluster ? $cluster->name : 'N/A';


            // })
            // ->addColumn('regionname', function ($row) {
            //     // return $row->user? ($row->user->region!=null ? $row->user->region->name : 'N/A') : 'N/A';
            //     return 'N/A';
            //     // $region_id=$row->user->region_id;
            //     // $region = Region::find($region_id);
            //     // return $region ? $region->name : 'N/A';
            // })
            // ->addColumn('territoryname', function ($row) {

            //     // return $row->user? ($row->user->region!=null ? $row->user->region->name : 'N/A') : 'N/A';
            //     return 'N/A';
            //     // $territory_id=$row->user->territory_id;
            //     // $territory = Territory::find($territory_id);
            //     // return $territory ? $territory->name : 'N/A';

            // })
            // ->addColumn('channeltypename', function ($row) {
            //     // return $row->outlet ? $row->outlet->phone : 'N/A';
            //     return 'N/A';
            //     // $channeltype_id=$row->outlet->channeltype_id;
            //     // $channeltype = ChannelType::find($channeltype_id);
            //     // return $channeltype ? $channeltype->name : 'N/A';
            // })

            // ->addColumn('channeltypename', function ($row) {
            //     // return $row->outlet->channeltype ? $row->outlet->channeltype->name : 'N/A';
            //     return 'NA';
            // })

            ->rawColumns(['date', 'time']) // Ensure columns are not escaped
            ->make(true);


        }

        public function showVisitsById($objectId,$object) {
            //$visits = Visit::all();
            $visits = Visit::with(['user' => function ($query) {
                $query->withTrashed();
            },'outlet' => function ($query) {
                $query->withTrashed();
            }])->where($object.'_id',$objectId)->get();
            return view('visit.index', ['visits'=>$visits]);
        }
                public function filterVisits(Request $request) {
            //$visits = Visit::all();
            $query = Visit::with(['user' => function ($query) {
                $query->withTrashed()->with('region','territory');
            },'outlet' => function ($query) {
                $query->withTrashed();
            }]); // Eager load relationships for efficiency

            if ($request->user) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->user . '%');
                });
            }

            if ($request->outlet) {
                $query->whereHas('outlet', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->outlet . '%');
                });
            }

            if ($request->from_date) {
                $query->whereDate('created_at', '>=', $request->from_date);
            }

            if ($request->to_date) {
                $query->whereDate('created_at', '<=', $request->to_date);
            }
                // Retrieve the current page from the request, defaulting to 1 if not set.
            $currentPage = $request->input('page', 1);

            // Explicitly pass the current page to the paginate() method.
            $visits = $query->orderBy('id', 'DESC')->paginate(500, ['*'], 'page', $currentPage);

            // $visits = $query->orderBy('id', 'DESC')->paginate(500);
            return response()->json(['visits'=>$visits]);
        }
        

        public function showEditVisit($id){
            //$visit = Visit::find($id);
            $visit=Visit::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get()->find($id);
            return view('visit.edit',['visit'=>$visit]);
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

            $visits = Visit::with([
                'user' => function ($query) {
                    $query->withTrashed();
                },
                'outlet'
            ])->orderBy('id', 'desc')->paginate(500);

            $users = User::inOrganization()->get();
            $outlets = Outlet::all();

            // return $visits;

            //$users = User::inOrganization()->where('usertype','seller')->get();
            return view('visit.map', compact('visits','users','outlets') );
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
            return view('visit.analytics', compact('visitsPerMonth','visits','users','outlets','months','visitsCount',
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
            },'visits.outlet'])->where('user_id',$objectId)
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
