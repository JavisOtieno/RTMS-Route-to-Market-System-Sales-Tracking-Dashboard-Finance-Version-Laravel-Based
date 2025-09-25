<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use App\Models\Visit;
use App\Models\Outlet;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VisitsExportDatatables;
use Yajra\DataTables\Facades\DataTables;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class OutletController extends CommonController
{

    public function ajaxOutletsYajraTest(Request $request)
    {
        $outlets = Outlet::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
        $query = Outlet::select(
            'outlets.*',
            // DB::raw("DATE_FORMAT(visits.created_at, '%d-%b-%Y') as date"),
            // DB::raw("DATE_FORMAT(visits.created_at, '%H:%i:%s') as time"),
            'regions.name as region_name',
            'territories.name as territory_name',
            // 'clusters.name as cluster_name',
            // 'channel_types.name as channeltypename',
            'teams.name as teamname',
            'users.name as user_name',
            // 'routes.name as routename',


        )
        ->leftJoin('users', 'users.id', '=', 'outlets.user_id')
        ->leftJoin('regions', 'regions.id', '=', 'users.region_id')
        ->leftJoin('territories', 'territories.id', '=', 'users.territory_id')
        // ->leftJoin('clusters', 'clusters.id', '=', 'users.cluster_id')
        // ->leftJoin('routes', 'routes.id', '=', 'outlets.route_id')
        ->leftJoin('teams', 'teams.id', '=', 'outlets.team_id');
        // ->leftJoin('channel_types', 'channel_types.id', '=', 'outlets.channel_type_id');
        // return $request;

        $toDate = \Carbon\Carbon::parse($request->to_date)->endOfDay();

        if (!empty($request->from_time)) {
            $query->whereRaw("TIME(outlets.created_at) >= ?", [$request->from_time]);
            }
            if (!empty($request->to_time)) {
                $query->whereRaw("TIME(outlets.created_at) <= ?", [$request->to_time]);
            }

            if (!empty($request->from_date)) {
                $query->whereDate('outlets.created_at', '>=', $request->from_date);
            }

            if (!empty($request->to_date)) {
                $query->whereDate('outlets.created_at', '<=', $request->to_date);
            }

        // $outlets = $query->get();
        // return DataTables::of($outlets)->make(true);
        // return DataTables::of($outlets)
        return DataTables::eloquent($query)
        ->addColumn('date', function ($outlet) {
            return $outlet->created_at->format('d-M-Y'); // Extract Date
        })
        // ->addColumn('routename', function ($row) {
        //     return $row->route ? $row->route->name : 'N/A';
        // })
        // ->addColumn('teamname', function ($row) {
        //     return $row->team ? $row->team->name : 'N/A';
        // })
        // ->addColumn('channeltypename', function ($row) {
        //     return $row->channeltype ? $row->channeltype->name : 'N/A';
        // })
        ->addColumn('time', function ($outlet) {
            return $outlet->created_at->format('H:i:s'); // Extract Time
        })
        ->rawColumns(['date', 'time']) // Ensure columns are not escaped



        ->make(true);


    }

    public function viewOutletsYajraTest()
    {
        return view('outlet.indexyajra');
    }
    //

    public function index() {
        // $outlets = Outlet::all();
        $outlets = Outlet::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
        return view('outlet.index', ['outlets'=>$outlets]);
        
    }

        public function showOutletsAnalytics(){



        // $visits = Outlet::with(['user' => function ($query) {
        //     $query->withTrashed();
        // }, 'outlet'])->get();

        $users = User::inOrganization()->get();
        // $outlets = Outlet::all();

        $outletsCount = Outlet::count();

        // $outletsPerMonth= array();
        // for ($i=0; $i<=11; $i++){
        //     $outletsPerMonth[$i] = Outlet::whereMonth('created_at', date('m',strtotime('-'.$i.' month')))->count();
        // }
        $start = now()->subMonths(11)->startOfMonth();
        $end   = now()->endOfMonth();

        // single grouped query, pluck by "YYYY-MM"
        $counts = Outlet::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as cnt")
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('ym')
            ->pluck('cnt', 'ym')
            ->toArray();

        // build visitsPerMonth with numeric indices (0 = this month)
        $outletsPerMonth = [];
        for ($i = 0; $i <= 11; $i++) {
            $key = now()->subMonths($i)->format('Y-m');
            $outletsPerMonth[$i] = $counts[$key] ?? 0;
        }
        $outletsPerMonth =array_reverse($outletsPerMonth);
        // $outletsPerMonth =array_reverse($outletsPerMonth);

        $dates = [];
        $dayNames = [];
        $outletsPerDay = array();
        for ($i = 0; $i <= 6; $i++) {

            $date = now()->subDays($i);
            $dateString = $date->toDateString();
            $dayName = $date->format('l'); // Get the day name (e.g., 'Monday')

            $dates[] = $dateString;
            $dayNames[] = $dayName;

            $date = now()->subDays($i)->toDateString();


            $outletsPerDay[$date] = Outlet::whereDate('created_at', $date)->count();
        }
        $outletsPerDay = array_reverse($outletsPerDay);
        $dates = array_reverse($dates);
        $dayNames = array_reverse($dayNames);


        $startOfMonth = date('Y-m-01 00:00:00'); // 1st day of the current month
        $today = date('Y-m-d 23:59:59'); // Current day
        $outletsThisMonth =Outlet::whereBetween('created_at', [$startOfMonth, $today])->count();

        $startOfWeek = Carbon::now()->startOfWeek(); // Start of the week (Monday)
        $today = Carbon::now()->endOfDay(); // Current day
        $outletsThisWeek = Outlet::whereBetween('created_at', [$startOfWeek, $today])->count();

        // Visits Today
        $startOfDay = Carbon::now()->startOfDay();
        $endOfDay = Carbon::now()->endOfDay();
        $outletsToday = Outlet::whereBetween('created_at', [$startOfDay, $endOfDay])->count();

        $dates = [];
        $dayNames = [];
        $outletsPerDay = array();
        for ($i = 0; $i <= 6; $i++) {

            $date = now()->subDays($i);
            $dateString = $date->toDateString();
            $dayName = $date->format('l'); // Get the day name (e.g., 'Monday')

            $dates[] = $dateString;
            $dayNames[] = $dayName;

            $date = now()->subDays($i)->toDateString();


            $outletsPerDay[$date] = Outlet::whereDate('created_at', $date)->count();
        }
        $outletsPerDay = array_reverse($outletsPerDay);
        $dates = array_reverse($dates);
        $dayNames = array_reverse($dayNames);


        $datesFiltered = [];
        $dayNamesFiltered = [];
        $outletsPerDayFiltered = array();
        for ($i = 1; $i <= 1; $i++) {

            // ->subDays($i)
            $dateFiltered = now();
            $dateStringFiltered = $dateFiltered->toDateString();
            $dayNameFiltered = $dateFiltered->format('l'); // Get the day name (e.g., 'Monday')

            $datesFiltered[] = $dateStringFiltered;
            $dayNamesFiltered[] = $dayNameFiltered;

            // ->subDays($i)
            $dateFiltered = now()->toDateString();


            $outletsPerDayFiltered[$dateFiltered] = Outlet::whereDate('created_at', $dateFiltered)->count();
        }
        $outletsPerDayFiltered = array_reverse($outletsPerDayFiltered);
        $datesFiltered = array_reverse($datesFiltered);
        $dayNamesFiltered = array_reverse($dayNamesFiltered);


                //get months Jan Feb Mar...Dec
        for ($i = 0; $i <= 11; $i++) {
                    $months[] = date("M", strtotime( date( 'Y-m-01' )." -$i months"));
                    }
                    //echo "Before";
                    //print_r($months);
                    //echo "After";
        $months=array_reverse($months);


        $sellersByRegionCount = array();
        $sellersByRegionNames = array();
        $sellersByRegion=User::inOrganization()->with(['region' => function ($query) {
            $query->withTrashed();
        }])->select('region_id', DB::raw('COUNT(region_id) as count'))
        ->groupBy('region_id')
        ->orderBy('count', 'desc')
        ->take(5)->get();

        $unassignedCount = 0;

        //return $sellersByRegion;
        foreach ($sellersByRegion as $seller) {
            # code...
            array_push($sellersByRegionCount,$seller['count']);
            if($seller['region']==null){
                array_push($sellersByRegionNames,"Unassigned");
            }else{
                array_push($sellersByRegionNames,$seller['region']['name']);
            }



        }


            $outletsData = Outlet::join('users', 'outlets.user_id', '=', 'users.id')
            ->join('regions', 'users.region_id', '=', 'regions.id')
            // ->select(DB::raw('COALESCE(regions.name, "Unknown Region") as region_name'), DB::raw('COUNT(sales.id) as total_sales_count'))
            ->select(DB::raw('COALESCE(regions.name, "Region not assigned") as region_name'), DB::raw('COUNT(outlets.id) as total_outlets_count'))
            ->groupBy('regions.name')
            ->get();

            // Extracting two separate arrays
            $regionNames = $outletsData->pluck('region_name')->toArray();
            $totalOutlets = $outletsData->pluck('total_outlets_count')->toArray();



        $outletcount = Outlet::whereDate('created_at', Carbon::today())->count();
        $outletcounttill8 = Outlet::whereDate('created_at', Carbon::today())
        ->whereTime('created_at', '>=', '00:00:00')
        ->whereTime('created_at', '<', '08:00:00')
        ->count();
        $outletcounttill16 = Outlet::whereDate('created_at', Carbon::today())
        ->whereTime('created_at', '>=', '08:00:00')
        ->whereTime('created_at', '<', '16:00:00')
        ->count();
        $outletcounttill24 = Outlet::whereDate('created_at', Carbon::today())
        ->whereTime('created_at', '>=', '16:00:00')
        ->whereTime('created_at', '<', '24:00:00')
        ->count();
        $outletfirst = Outlet::whereDate('created_at', Carbon::today())->first();
        $outletfirst =$outletfirst ? (date('H:i', strtotime($outletfirst['created_at']))) :'N/A';
        $outletlast =  Outlet::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->first();
        $outletlast =$outletlast ? (date('H:i', strtotime($outletlast['created_at']))) :'N/A';




        //$users = User::inOrganization()->where('usertype','seller')->get();
        return view('outlet.analytics', compact('outletsPerMonth','months','outletsCount',
        'outletsThisMonth', 'outletsThisWeek','outletsToday','dates','outletsPerDay'
        ,'outletcount','outletcounttill8','outletcounttill16','outletcounttill24',
        'outletfirst','outletlast','outletsPerDayFiltered','datesFiltered','dayNamesFiltered',
        'regionNames','totalOutlets'
        ) );
    }

    public function filterOutletsAnalytics(Request $request) {
        //$visits = Visit::all();
        $query = Outlet::with(['user' => function ($query) {
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

        $outletcount = $query->count();
        $outletcounttill16 = (clone $query)
        ->whereTime('created_at', '>=', '08:00:00')
        ->whereTime('created_at', '<', '16:00:00')
        ->count();

        $outletcounttill8 = (clone $query)
        ->whereTime('created_at', '>=', '00:00:00')
        ->whereTime('created_at', '<', '08:00:00')
        ->count();

        // $outletcounttill16 = $query
        // ->whereTime('created_at', '>=', '08:00:00')
        // ->whereTime('created_at', '<', '16:00:00')
        // ->count();

        $outletcounttill24 = (clone $query)
        ->whereTime('created_at', '>=', '16:00:00')
        ->whereTime('created_at', '<', '24:00:00')
        ->count();
        // $outletfirst = (clone $query)->first();
        // $outletfirst =$outletfirst ? (date('H:i', strtotime($outletfirst['created_at']))) :'N/A';
        // $outletlast = (clone $query)->orderBy('created_at', 'desc')->first();
        // $outletlast =$outletlast ? (date('H:i', strtotime($outletlast['created_at']))) :'N/A';

        $outletfirst = (clone $query)
            ->orderByRaw("TIME(created_at) ASC")
            ->first();
        $outletfirst = $outletfirst ? date('H:i', strtotime($outletfirst['created_at'])) : 'N/A';

        $outletlast = (clone $query)
            ->orderByRaw("TIME(created_at) DESC")
            ->first();
        $outletlast = $outletlast ? date('H:i', strtotime($outletlast['created_at'])) : 'N/A';
                // $outletfirst = date('H:i', strtotime($outletfirst['created_at']));

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

                $datesFiltered = [];
                $dayNamesFiltered = [];
                $outletsPerDayFiltered = array();
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
                    $outletsPerDayFiltered[$dateStringFiltered] = Outlet::whereDate('created_at', $dateStringFiltered)->count();
                }

                $outletsPerDayFiltered = array_reverse($outletsPerDayFiltered);
                $datesFiltered = array_reverse($datesFiltered);
                $dayNamesFiltered = array_reverse($dayNamesFiltered);


        // $visits = $query->orderBy('id', 'DESC')->paginate(500);
        return response()->json(compact('outletcount','outletcounttill8',
        'outletcounttill16','outletcounttill24','outletfirst','outletlast',
        'outletsPerDayFiltered','datesFiltered','dayNamesFiltered',
        
    ));
    }

//     public function export(Request $request)
// {
//     $filters = [
//         'search' => $request->input('search.value'),
//         'columns' => [],
//         'dateFrom' => $request->input('dateFrom'),
//         'dateTo' => $request->input('dateTo'),
//         'timeFrom' => $request->input('timeFrom'),
//         'timeTo' => $request->input('timeTo'),
//     ];

//     // Build a dynamic column map from the DataTables payload
//     $columnMap = [];
//     foreach ($request->input('columns', []) as $index => $col) {
//         $key = $col['data'] ?? $col['name'] ?? null;
//         if (!$key) continue;

//         // sanitize key: allow letters, numbers, dot, underscore only
//         // prevents injection like "users.name; DROP TABLE..."
//         if (!preg_match('/^[a-z0-9_.]+$/i', $key)) continue;

//         $columnMap[$index] = $key;
//     }

//     // Collect any per-column searches (ignore action-like columns by name)
//     foreach ($request->input('columns', []) as $index => $col) {
//         $searchVal = $col['search']['value'] ?? null;
//         if (trim((string)$searchVal) === '') continue;

//         $mapped = $columnMap[$index] ?? null;
//         if (!$mapped) continue;

//         // optional: ignore UI columns named "actions"
//         if (stripos($mapped, 'action') !== false) continue;

//         // Save as-is — later exported class should use bindings when applying filters
//         $filters['columns'][$mapped] = $searchVal;
//     }

//     return Excel::download(new OutletsExportDatatables($filters), 'customers.xlsx');
// }

    public function showOutletsById($objectId,$object) {
        // $outlets = Outlet::all();
        $outlets = Outlet::with(['user' => function ($query) {
            $query->withTrashed();
        }])->where($object.'_id',$objectId)->get();
        return view('outlet.index', ['outlets'=>$outlets]);
        
    }

    //delete outlet not allowed
    public function deleteOutlet($id){
        $outlet = Outlet::findOrFail($id);
        if (Gate::denies('delete', $outlet)) {
            abort(403, 'Access denied');
        }
        // $outlet = Outlet::find($id);
        $outlet->delete();
        return redirect('/outlets');
    }

    public function addOutlet() {
        $teams = Team::all();
        $users = User::inOrganization()->where('usertype','seller')->get();
        return view('outlet.create',compact('users','teams'));
    }
    public function saveOutlet(Request $request){

        $organization_id=auth()->user()->organization_id;
        $team_id=$this->teamIdCheckAssign($request);
        
        $incomingFields=$request->validate([
            'userId'=>'required|numeric|digits_between:1,20|exists:users,id',
            'name'=>'required|string|max:255',
            'contactName'=>'required|string|max:255',
            'phone'=>['required','string','min:10','max:255', new PhoneNumber],
            'lat' => 'required|numeric|between:-90,90',
            'long' => 'required|numeric|between:-180,180',
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        
        $incomingFields['user_id']=strip_tags($incomingFields['userId']);
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['contact_person_name']=strip_tags($incomingFields['contactName']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['lat']=strip_tags($incomingFields['lat']);
        $incomingFields['long']=strip_tags($incomingFields['long']);
        $incomingFields['organization_id']=$organization_id;
        $incomingFields['team_id']=$team_id;
        //$incomingFields['image']='';

        //return $request['image'];
        

        if($request->hasFile('image')){

            $imageName = time().'.jpg';

            $request->validate([
                'image' => 'image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048'
            ]);

            // Save image to public/images directory
            //$request->image->move(public_path('images'), $imageName);
    
            //code from android version
            $folder="outlets";
            $imagePathOnDb=$folder."/".$imageName;
            //Storage::disk('public')->put($imagePath, $imageData);
            $incomingFields['image']=$imagePathOnDb;
    
            $image = $request->file('image');
            $imagePath = $image->getPathName();
            $compressedImagePath = storage_path('app/public/outlets/'.$imageName);

            $sourcePath = $imagePath;
            $maxSizeKB = 100;
            $destinationPath = $compressedImagePath;

            $this->compressImage($sourcePath,$destinationPath,$maxSizeKB);
            
            
        }else{
            $incomingFields['image']='';   
        }

        Outlet::create($incomingFields);

        return redirect('/outlets');
        
    }
    public function showEditOutlet($id){
        $teams = Team::all();
        $outlet = Outlet::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get()->find($id);
        return view('outlet.edit',compact('outlet','teams'));
    }
    // public function showEditOutlet(Request $request){
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $outlet = Outlet::find($incomingFields['id']);
    //     return view('edit-outlet',compact('outlet'));
    // }
    public function saveEditOutlet($id, Request $request){
        // $organization_id=auth()->user()->organization_id;
        // $team_id=auth()->user()->team_id;
        $team_id=$this->teamIdCheckAssign($request);
        $incomingFields=$request->validate([
            'userId'=>'required|numeric|digits_between:1,20|exists:users,id',
            'name'=>'required|string|max:255',
            'contactPersonName'=>'required|string|max:255',
            'phone'=>['required','min:10','string','max:255', new PhoneNumber],
            'lat' => 'required|numeric|between:-90,90',
            'long' => 'required|numeric|between:-180,180',
        ]);

        $incomingFields['user_id']=strip_tags($incomingFields['userId']);
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['contact_person_name']=strip_tags($incomingFields['contactPersonName']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['lat']=strip_tags($incomingFields['lat']);
        $incomingFields['long']=strip_tags($incomingFields['long']);
        // $incomingFields['organization_id']=$organization_id;
        $incomingFields['team_id']=$team_id;

        $outlet = Outlet::findOrFail($id);
        if (Gate::denies('update', $outlet)) {
            abort(403, 'Access denied');
        }

        // $outlet=Outlet::find($id);

        $outlet->update($incomingFields);

        return redirect('/outlets');
        
    }
    

    public function showAddOutletsToUsers() {
        //$outlets = Outlet::all();
        $outlets = Outlet::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
        $users = User::inOrganization()->where('usertype','seller')->get();
        //dd($sales);
        //return 'heh';
        return view('add-outlets-to-user', compact('outlets','users') );
    }
        public function filterOutlets(Request $request) {
        //$visits = Visit::all();
        $query = Outlet::with(['user' => function ($query) {
            $query->withTrashed()->with('region','territory');
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
        $outlets = $query->orderBy('id', 'DESC')->paginate(500, ['*'], 'page', $currentPage);

        // $visits = $query->orderBy('id', 'DESC')->paginate(500);
        return response()->json(['outlets'=>$outlets]);
    }

    public function showOutletsMap(){
        $outlets = Outlet::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();

        
       
        $users = User::inOrganization()->where('usertype','seller')->get();
        return view('outlet.map', compact('outlets','users') );
    }

    

    public function pushOutletsToUser(Request $request) {

        //return $request->input('checkboxes',[]);
       
        $incomingFields=$request->validate([
            'user_id'=>'required|numeric|digits_between:1,11|not_in:0',
             'outletcheckboxes' => 'required|array|min:1',
        ],[
            'outletcheckboxes.required' => 'You must select at least one outlet.',
            'outletcheckboxes.min' => 'You must select at least one outlet.',
            'user_id.not_in' => 'You must select a valid seller.',
        ]);
    
        //$selectedOutlets = $request->input('outlets', []);
        $selectedOutlets = $request->input('outletcheckboxes', []);
        

        // Process the selected items
        foreach ($selectedOutlets as $selectedOutletId) {
            $outlet = Outlet::find($selectedOutletId);
            $outlet->update($incomingFields);
           
            // Perform your processing here
            // For example, you can mark the item as processed, delete it, etc.
        }
        
        return redirect('/allocateoutletstousers');
        //dd($sales);
        //return view('add-users-to-target-group', compact('users','targetgroups') );
    }

}
