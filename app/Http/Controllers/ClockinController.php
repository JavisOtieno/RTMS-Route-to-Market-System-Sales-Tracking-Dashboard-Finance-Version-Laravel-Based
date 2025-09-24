<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Region;
use App\Models\Clockin;
use Illuminate\Http\Request;
use App\Mail\ReportSenderTest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\ClockinsExportDatatables;

class ClockinController extends Controller

//test
{
    //
    public function apiindex()
    {
        $clockins = Clockin::all();
        return response()->json(['clockins' => $clockins]);
    }
    public function index()
    {
        //$clockins = Clockin::all();
        $clockins = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();

        // $clockin = Clockin::first();
        //     Mail::to('javisotieno@gmail.com',
        //     // 'Technology@scgafrica.com','stanley@scgafrica.com'
        //     )->send(new ReportSenderTest($clockin));

        return view('clockin.index', ['clockins' => $clockins]);
    }
    public function indexVisitsYajra()
    {
        return view('clockin.indexyajravisits');
    }
    public function clockinsVisitsYajra(Request $request)
    {
        // Eager relationships used for rendering details
        $withRelations = [
            'user' => function ($q) {
                $q->withTrashed();
            },
            'clockout' => function ($q) {
                $q->withTrashed();
            },
            // 'visits'
            'visits.outlet'
        ];

        // Base query (eager load + flat columns via joins for searching/sorting)
        $query = Clockin::with($withRelations)
            ->select(
                'clockins.*',
                'users.name as user_name',
                'outlets.name as outlet_name',
                'outlets.contact_person_name as contactpersonname',
                'outlets.phone as outlet_phone'
            )
            ->leftJoin('users', 'users.id', '=', 'clockins.user_id')
            ->leftJoin('visits', 'visits.clockin_id', '=', 'clockins.id')
            ->leftJoin('outlets', 'outlets.id', '=', 'visits.outlet_id');

        // Filters from request (same names as your form inputs)
        if (!empty($request->from_date)) {
            $query->whereDate('clockins.created_at', '>=', $request->from_date);
        }
        if (!empty($request->to_date)) {
            $query->whereDate('clockins.created_at', '<=', $request->to_date);
        }
        if (!empty($request->from_time)) {
            $query->whereRaw("TIME(clockins.created_at) >= ?", [$request->from_time]);
        }
        if (!empty($request->to_time)) {
            $query->whereRaw("TIME(clockins.created_at) <= ?", [$request->to_time]);
        }

        return DataTables::eloquent($query)
            ->addColumn('date', function ($row) {
                return optional($row->created_at)->format('d-M-Y') ?: '';
            })
            ->addColumn('time', function ($row) {
                return optional($row->created_at)->format('H:i') ?: '';
            })
            ->addColumn('name', function ($row) {
                // Mirror your blade: show deleted note if trashed
                if ($row->user) {
                    return $row->user->name . ($row->user->trashed() ? ' (Deleted User)' : '');
                }
                return 'Deleted User';
            })
            ->addColumn('map', function ($row) {
                // We'll send whole row to frontend; render button (JS will pass row JSON)
                return '<a class="btn btn-success" data-bs-toggle="modal" href="#largemodal" '
                    . 'onclick="rewriteMap(JSON.parse(decodeURIComponent(\'' . rawurlencode(json_encode($row->toArray())) . '\')))">Map</a>';
            })
            // allow ordering/searching on user_name via join
            ->orderColumn('user_name', 'users.name $1')
            ->filterColumn('user_name', function ($q, $keyword) {
                $q->whereRaw("users.name like ?", ["%{$keyword}%"]);
            })
            ->rawColumns(['map'])
            ->make(true);
    }
    public function clockinsYajra(Request $request)
    {

        $clockins = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }], 'user.region', 'user.territory')->get();
        // return DataTables::of($clockins)->make(true);
        $query = Clockin::select(
            'clockins.*',
            // DB::raw("DATE_FORMAT(clockins.created_at, '%d-%b-%Y') as date"),
            // DB::raw("DATE_FORMAT(clockins.created_at, '%H:%i:%s') as time"),
            // DB::raw("DATE_FORMAT(FROM_UNIXTIME(clockins.checkout_time), '%H:%i:%s') as checkout_time"),
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
            // ->leftJoin('outlets', 'outlets.id', '=', 'clockins.outlet_id')
            // ->leftJoin('channel_types', 'channel_types.id', '=', 'outlets.channel_type_id')
            ->leftJoin('users', 'users.id', '=', 'clockins.user_id')
            // // skjdjkjfjhsjkhdfks
            ->leftJoin('teams', 'teams.id', '=', 'clockins.team_id')
            ->leftJoin('regions', 'regions.id', '=', 'users.region_id')
            ->leftJoin('territories', 'territories.id', '=', 'users.territory_id');
        // ->leftJoin('clusters', 'clusters.id', '=', 'users.cluster_id');

        // $toDate = \Carbon\Carbon::parse($request->to_date)->endOfDay();
        // $fromDate = \Carbon\Carbon::parse($request->from_date)->startOfDay();

        // if ($request->has('from_date') && $request->has('to_date')) {
        //     if(!empty($request->from_date) && !empty($request->to_date)){
        //         $query->whereBetween('clockins.created_at', [$fromDate, $toDate]);
        //     }else if(!empty($request->from_date)){
        //         $query->where('clockins.created_at', '>=', $fromDate);
        //     }
        //     else if(!empty($request->to_date)){
        //         $query->where('clockins.created_at', '<=', $toDate);
        //     }

        // }

        // if (!empty($request->from_time)) {
        // $query->whereRaw("TIME(clockins.created_at) >= ?", [$request->from_time]);
        // }
        // if (!empty($request->to_time)) {
        //     $query->whereRaw("TIME(clockins.created_at) <= ?", [$request->to_time]);
        // }
        if (!empty($request->from_time)) {
            $query->whereRaw("TIME(clockins.created_at) >= ?", [$request->from_time]);
        }
        if (!empty($request->to_time)) {
            $query->whereRaw("TIME(clockins.created_at) <= ?", [$request->to_time]);
        }

        if (!empty($request->from_date)) {
            $query->whereDate('clockins.created_at', '>=', $request->from_date);
        }

        if (!empty($request->to_date)) {
            $query->whereDate('clockins.created_at', '<=', $request->to_date);
        }

        // $clockins = $query->get();

        // ->join('outlets', 'outlets.id', '=', 'clockins.outlet_id')
        // ->get();
        // return DataTables::of($clockins)
        return DataTables::eloquent($query)
            ->addColumn('date', function ($clockin) {
                return $clockin->created_at->format('d-M-Y'); // Extract Date
            })
            // ->addColumn('checkout_time', function ($clockin) {
            //     // return $clockin->checkout_time->format('d-M-Y'); // Extract Date
            //     if($clockin['checkout_time']=="")
            //         return 'Not Checked Out';
            //     else
            //         return date('H:i:s',$clockin['checkout_time']);
            // })
            // ->addColumn('duration', function ($clockin) {
            //     // return $clockin->checkout_time->format('d-M-Y'); // Extract Date
            //     if($clockin['checkout_time']=="")
            //         return gmdate("H:i:s", strtotime(0));
            //     else
            //         return gmdate("H:i:s", ($clockin['checkout_time']-strtotime($clockin['created_at'])));
            // })
            ->addColumn('time', function ($clockin) {
                return $clockin->created_at->format('H:i:s'); // Extract Time
            })



            ->rawColumns(['date', 'time']) // Ensure columns are not escaped
            ->make(true);
    }
    public function export(Request $request)
    {
        Log::info('Export Request Parameters:', $request->all());

        $filters = [
            'search' => $request->input('search.value'),
            'columns' => [],
            'dateFrom' => $request->input('dateFrom'),
            'dateTo' => $request->input('dateTo'),
            'timeFrom' => $request->input('timeFrom'),
            'timeTo' => $request->input('timeTo'),
        ];

        $columnMap = [
            0 => 'id',
            1 => 'actions',
            2 => 'user_name',
            3 => 'team_name',
            4 => 'region_name',
            5 => 'territory_name',
            // 6 => 'cluster_name',
            7 => 'date',
            8 => 'time',
            9 => 'lat',
            10 => 'long',
            11 => 'actions',
        ];

        foreach ($request->input('columns', []) as $index => $column) {
            if (!empty($column['search']['value']) && $columnMap[$index] !== 'actions') {
                $filters['columns'][$columnMap[$index]] = $column['search']['value'];
            }
        }

        return Excel::download(new ClockinsExportDatatables($filters), 'clockins.xlsx');
    }

    public function indexClockinsYajra()
    {
        return view('clockin.indexyajra');
    }

    public function showClockinsById($objectId, $object)
    {
        //$clockins = Clockin::all();
        $clockins = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }])->where($object . '_id', $objectId)->get();

        return view('clockin.index', ['clockins' => $clockins]);
    }
    public function showEditClockin($id)
    {
        // $clockin = Clockin::find($id);
        $clockin = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get()->find($id);
        return view('clockin.edit', ['clockin' => $clockin]);
    }
    public function showClockinsMap()
    {
        $clockins = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();


        $users = User::inOrganization()->where('usertype', 'seller')->get();

        return view('clockin.map', compact('clockins', 'users'));
    }
    // public function showEditClockin(Request $request){
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $clockin = Clockin::find($incomingFields['id']);
    //     return view('edit-clockin',['clockin'=>$clockin]);
    // }
    public function filterClockins(Request $request)
    {
        //$visits = Visit::all();
        $query = Clockin::with(['user' => function ($query) {
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
        // Retrieve the current page from the request, defaulting to 1 if not set.
        $currentPage = $request->input('page', 1);

        // Explicitly pass the current page to the paginate() method.
        $clockins = $query->orderBy('id', 'DESC')->paginate(500, ['*'], 'page', $currentPage);

        // $visits = $query->orderBy('id', 'DESC')->paginate(500);
        return response()->json(['clockins' => $clockins]);
    }
    public function showClockinsAnalytics()
    {

        $clockins = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();

        $users = User::inOrganization()->get();
        $outlets = Outlet::all();
        $teams = Team::all();
        $regions = Region::all();

        $clockinsCount = Clockin::all()->count();

        // $clockinsPerMonth= array();
        // for ($i=0; $i<=11; $i++){
        //     $clockinsPerMonth[$i] = Clockin::whereMonth('created_at', date('m',strtotime('-'.$i.' month')))->count();
        // }
        // $clockinsPerMonth =array_reverse($clockinsPerMonth);

        // $dates = [];
        // $dayNames = [];
        // $clockinsPerDay = array();
        // for ($i = 1; $i <= 7; $i++) {

        //     $date = now()->subDays($i);
        //     $dateString = $date->toDateString();
        //     $dayName = $date->format('l'); // Get the day name (e.g., 'Monday')

        //     $dates[] = $dateString;
        //     $dayNames[] = $dayName;

        //     $date = now()->subDays($i)->toDateString();


        //     $clockinsPerDay[$date] = Clockin::whereDate('created_at', $date)->count();
        // }
        // $clockinsPerDay = array_reverse($clockinsPerDay);
        // $dates = array_reverse($dates);
        // $dayNames = array_reverse($dayNames);
        // Monthly clockins (last 12 months, including current)
        $startMonth = now()->subMonths(11)->startOfMonth();
        $endMonth   = now()->endOfMonth();
        $clockinsRows = Clockin::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->groupBy('year', 'month')
            ->get()
            ->keyBy(fn($r) => $r->year . '-' . str_pad($r->month, 2, '0', STR_PAD_LEFT));
        $clockinsPerMonth = [];
        for ($i = 11; $i >= 0; $i--) {
            $dt = now()->subMonths($i);
            $key = $dt->format('Y-m');
            $clockinsPerMonth[] = isset($clockinsRows[$key]) ? (int)$clockinsRows[$key]->total : 0;
        }
        // Daily clockins (last 7 days, excluding today)
        $periodStart = now()->subDays(7)->startOfDay();
        $periodEnd   = now()->subDays(1)->endOfDay(); // up to yesterday
        $clockinsDailyRows = Clockin::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween('created_at', [$periodStart, $periodEnd])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get()
            ->keyBy('date');
        $dates = [];
        $dayNames = [];
        $clockinsPerDay = [];
        for ($i = 1; $i <= 7; $i++) {
            $dt = now()->subDays($i);
            $dateString = $dt->toDateString();
            $dayName = $dt->format('l');
            $dates[] = $dateString;
            $dayNames[] = $dayName;
            $clockinsPerDay[$dateString] = isset($clockinsDailyRows[$dateString]) ? (int)$clockinsDailyRows[$dateString]->total : 0;
        }
        $clockinsPerDay = array_reverse($clockinsPerDay);
        $dates = array_reverse($dates);
        $dayNames = array_reverse($dayNames);


        $datesFiltered = [];
        $dayNamesFiltered = [];
        $clockinsPerDayFiltered = array();
        for ($i = 1; $i <= 1; $i++) {

            // ->subDays($i)
            $dateFiltered = now();
            $dateStringFiltered = $dateFiltered->toDateString();
            $dayNameFiltered = $dateFiltered->format('l'); // Get the day name (e.g., 'Monday')

            $datesFiltered[] = $dateStringFiltered;
            $dayNamesFiltered[] = $dayNameFiltered;

            // ->subDays($i)
            $dateFiltered = now()->toDateString();


            $clockinsPerDayFiltered[$dateFiltered] = Clockin::whereDate('created_at', $dateFiltered)->count();
        }
        $clockinsPerDayFiltered = array_reverse($clockinsPerDayFiltered);
        $datesFiltered = array_reverse($datesFiltered);
        $dayNamesFiltered = array_reverse($dayNamesFiltered);




        $startOfMonth = date('Y-m-01 00:00:00'); // 1st day of the current month
        $today = date('Y-m-d 23:59:59'); // Current day
        $clockinsThisMonth = Clockin::whereBetween('created_at', [$startOfMonth, $today])->count();

        $startOfWeek = Carbon::now()->startOfWeek(); // Start of the week (Monday)
        $today = Carbon::now()->endOfDay(); // Current day
        $clockinsThisWeek = Clockin::whereBetween('created_at', [$startOfWeek, $today])->count();

        // Clockins Today
        $startOfDay = Carbon::now()->startOfDay();
        $endOfDay = Carbon::now()->endOfDay();
        $clockinsToday = Clockin::whereBetween('created_at', [$startOfDay, $endOfDay])->count();


        //get months Jan Feb Mar...Dec
        for ($i = 0; $i <= 11; $i++) {
            $months[] = date("M", strtotime(date('Y-m-01') . " -$i months"));
        }
        //echo "Before";
        //print_r($months);
        //echo "After";
        $months = array_reverse($months);

        $clockincount = Clockin::whereDate('created_at', Carbon::today())->count();

        $clockinswithoutclockouts = Clockin::whereDate('created_at', Carbon::today())
            ->doesntHave('clockout')->count();

        $clockincount = Clockin::whereDate('created_at', Carbon::today())->count();
        $clockincounttill8 = Clockin::whereDate('created_at', Carbon::today())
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<', '08:00:00')
            ->count();
        $clockincounttill16 = Clockin::whereDate('created_at', Carbon::today())
            ->whereTime('created_at', '>=', '08:00:00')
            ->whereTime('created_at', '<', '16:00:00')
            ->count();
        $clockincounttill24 = Clockin::whereDate('created_at', Carbon::today())
            ->whereTime('created_at', '>=', '16:00:00')
            ->whereTime('created_at', '<', '24:00:00')
            ->count();
        $clockinfirst = Clockin::whereDate('created_at', Carbon::today())->first();
        $clockinfirst = $clockinfirst ? (date('H:i', strtotime($clockinfirst['created_at']))) : 'N/A';
        $clockinlast =  Clockin::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->first();
        $clockinlast = $clockinlast ? (date('H:i', strtotime($clockinlast['created_at']))) : 'N/A';



        //$users = User::inOrganization()->where('usertype','seller')->get();
        return view('clockin.analytics', compact(
            'clockinsPerMonth',
            'clockins',
            'users',
            'outlets',
            'months',
            'clockinsCount',
            'clockinsThisMonth',
            'clockinsThisWeek',
            'clockinsToday',
            'clockinsPerDay',
            'dates',
            'dayNames',
            'teams',
            'regions',
            'clockincount',
            'clockincounttill8',
            'clockincounttill16',
            'clockincounttill24',
            'clockinfirst',
            'clockinlast',
            'clockinswithoutclockouts',
            'clockinsPerDayFiltered',
            'datesFiltered',
            'dayNamesFiltered'
        ));
    }

    public function filterClockinsAnalytics(Request $request)
    {
        //$visits = Visit::all();
        $query = Clockin::with(['user' => function ($query) {
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

        // if ($request->team_id) {
        // $query->whereRaw("team_id = ?", [$request->team_id]);
        // }
        if ($request->team_id) {
            if ($request->team_id == "0") {
                // $query->whereRaw("team_id = null");
            } else {
                $query->whereRaw("team_id = ?", [$request->team_id]);
            }
            // $query->whereRaw("team_id = ?", [$request->team_id]);
        }

        if ($request->region_id) {
            if ($request->region_id == "0") {
                // $query->whereRaw("team_id = null");
            } else {
                // $query->whereRaw("region_id = ?", [$request->region_id]);
                $query->when($request->region_id && $request->region_id != "0", function ($query) use ($request) {
                    return $query->whereHas('user', function ($q) use ($request) {
                        $q->where('region_id', $request->region_id);
                    });
                });
            }
            // $query->whereRaw("team_id = ?", [$request->team_id]);
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

        $clockincount = $query->count();

        $clockincounttill16 = (clone $query)
            ->whereTime('created_at', '>=', '08:00:00')
            ->whereTime('created_at', '<', '16:00:00')
            ->count();

        $clockinswithoutclockouts = (clone $query)
            ->doesntHave('clockout')->count();


        $clockincounttill8 = (clone $query)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<', '08:00:00')
            ->count();
        // $clockincounttill16 = $query
        // ->whereTime('created_at', '>=', '08:00:00')
        // ->whereTime('created_at', '<', '16:00:00')
        // ->count();

        $clockincounttill24 = (clone $query)
            ->whereTime('created_at', '>=', '16:00:00')
            ->whereTime('created_at', '<', '24:00:00')
            ->count();
        // $clockinfirst = (clone $query)->first();
        // $clockinfirst =$clockinfirst ? (date('H:i', strtotime($clockinfirst['created_at']))) :'N/A';
        // $clockinlast = (clone $query)->orderBy('created_at', 'desc')->first();
        // $clockinlast =$clockinlast ? (date('H:i', strtotime($clockinlast['created_at']))) :'N/A';

        $clockinfirst = (clone $query)
            ->orderByRaw("TIME(created_at) ASC")
            ->first();
        $clockinfirst = $clockinfirst ? date('H:i', strtotime($clockinfirst['created_at'])) : 'N/A';

        $clockinlast = (clone $query)
            ->orderByRaw("TIME(created_at) DESC")
            ->first();
        $clockinlast = $clockinlast ? date('H:i', strtotime($clockinlast['created_at'])) : 'N/A';
        // $clockinfirst = date('H:i', strtotime($clockinfirst['created_at']));

        $fromDate = Carbon::parse($request->from_date); // Assuming $request->from_date is a valid date string


        if ($request->from_date) {
            $fromDate = Carbon::parse($request->from_date); // Assuming $request->from_date is a valid date string
        } else {
            $fromDate = Carbon::now()->startOfMonth(); // Defaults to the first day of the current month
        }

        if ($request->to_date) {
            $toDate = Carbon::parse($request->to_date);
        } else {
            $toDate = Carbon::now(); // Get current date and time
        }

        //         $diffInDays = $fromDate->diffInDays($toDate)+1;
        //         //include the date before

        //         $datesFiltered = [];
        //         $dayNamesFiltered = [];
        //         $clockinsPerDayFiltered = array();
        // // Loop through each day in the date range
        // for ($i = 0; $i < $diffInDays; $i++) {
        //     // Create a copy of $toDate for each iteration, so the original $toDate is not modified
        //     $currentDate = $toDate->copy()->subDays($i);

        //     // Get the date string and day name
        //     $dateStringFiltered = $currentDate->toDateString();
        //     $dayNameFiltered = $currentDate->format('l'); // Get the day name (e.g., 'Monday')

        //     // Store the date, day name, and clock-in count
        //     $datesFiltered[] = $dateStringFiltered;
        //     $dayNamesFiltered[] = $dayNameFiltered;

        //     // Get the count of clock-ins for the specific date
        //     $clockinsPerDayFiltered[$dateStringFiltered] = Clockin::whereDate('created_at', $dateStringFiltered)->count();
        // }

        //         $clockinsPerDayFiltered = array_reverse($clockinsPerDayFiltered);
        //         $datesFiltered = array_reverse($datesFiltered);
        //         $dayNamesFiltered = array_reverse($dayNamesFiltered);

        // Total days in range (inclusive)
        $diffInDays = $fromDate->diffInDays($toDate) + 1;

        // Pull all clock-ins in a single query, grouped by date
        // $clockins = Clockin::select(
        //         DB::raw('DATE(created_at) as date'),
        //         DB::raw('COUNT(*) as total')
        //     )

        //     ->whereBetween('created_at', [$fromDate->copy()->startOfDay(), $toDate->copy()->endOfDay()])
        //     ->groupBy('date')
        //     ->pluck('total', 'date'); // returns associative array: ['2025-08-20' => 5, ...]

        $clockins = Clockin::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->when($request->team_id != "0", function ($query) use ($request) {
                return $query->whereRaw("team_id = ?", [$request->team_id]);
            })
            // ->when($request->region_id != "0", function ($query) use ($request) {
            //     return $query->whereRaw("region_id = ?", [$request->region_id]);
            // })
            ->when($request->region_id && $request->region_id != "0", function ($query) use ($request) {
                return $query->whereHas('user', function ($q) use ($request) {
                    $q->where('region_id', $request->region_id);
                });
            })
            ->whereBetween('created_at', [$fromDate->copy()->startOfDay(), $toDate->copy()->endOfDay()])
            ->groupBy('date')
            ->pluck('total', 'date');
        $query->whereRaw("team_id = ?", [$request->team_id]);


        $datesFiltered = [];
        $dayNamesFiltered = [];
        $clockinsPerDayFiltered = [];

        // Build results in chronological order
        for ($i = $diffInDays - 1; $i >= 0; $i--) {
            $currentDate = $fromDate->copy()->addDays($i);
            $dateString = $currentDate->toDateString();

            $datesFiltered[] = $dateString;
            $dayNamesFiltered[] = $currentDate->format('l');
            $clockinsPerDayFiltered[$dateString] = $clockins[$dateString] ?? 0;
        }
        $clockinsPerDayFiltered = array_reverse($clockinsPerDayFiltered, true); // preserve date keys
        $datesFiltered          = array_reverse($datesFiltered);
        $dayNamesFiltered       = array_reverse($dayNamesFiltered);


        // $visits = $query->orderBy('id', 'DESC')->paginate(500);
        return response()->json(compact(
            'clockincount',
            'clockincounttill8',
            'clockinswithoutclockouts',
            'clockincounttill16',
            'clockincounttill24',
            'clockinfirst',
            'clockinlast',
            'clockinsPerDayFiltered',
            'datesFiltered',
            'dayNamesFiltered',
        ));
    }
}
