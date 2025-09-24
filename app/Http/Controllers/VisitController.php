<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Visit;
use App\Models\Outlet;
use App\Models\Clockin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VisitsExportDatatables;
use Illuminate\Support\Facades\Storage;
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
            'followups',
            'sales.saleitems.product',
            'feedbacks',
            ])->get();
            return view('visit.index', ['visits'=>$visits]);
        }
        public function indexYajra() {
            return view('visit.indexyajra');
        }

        public function visitsYajra(Request $request)
        {

            // Keep a hydrated Visit collection with relationships for rendering nested details
            $withRelations = ['team','user' => function ($query) {
                $query->withTrashed()->with('region','territory');
            }, 'outlet' => function ($query) {
                $query->withTrashed();
            }, 'followups', 'sales.saleitems.product', 'feedbacks'];

            // Base select with join aliases (for flat columns the table expects)
            $query = Visit::with($withRelations)
            ->select(
                'visits.*',
                'regions.name as region_name',
                'territories.name as territory_name',
                'outlets.long as outlet_long',
                'outlets.lat as outlet_lat',
                'teams.name as team_name',
                'users.name as user_name',
                'outlets.name as outlet_name',
                'outlets.contact_person_name as contactpersonname',
                'outlets.phone as phone'
            )
            ->leftJoin('outlets', 'outlets.id', '=', 'visits.outlet_id')
            ->leftJoin('users', 'users.id', '=', 'visits.user_id')
            ->leftJoin('teams', 'teams.id', '=', 'visits.team_id')
            ->leftJoin('regions', 'regions.id', '=', 'users.region_id')
            ->leftJoin('territories', 'territories.id', '=', 'users.territory_id')
            // ->leftJoin('teams', 'teams.id', '=', 'visits.team_id')
            // ->where(function ($query) use ($request) {
            //     if (!empty($request->team_name)) {
            //         $query->where('teams.name', 'like', '%' . strtolower($request->team_name) . '%');
            //     }
            // })
            ;

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

            // $visits = $query->get();

            // return DataTables::of($visits)
            // ->addColumn('date', function ($visit) {
            //     return $visit->created_at->format('d-M-Y');
            // })
            // ->addColumn('time', function ($visit) {
            //     return $visit->created_at->format('H:i:s');
            // })
            // ->addColumn('sales_list', function ($visit) {
            //     if (!isset($visit->sales) || count($visit->sales) === 0) {
            //         return '<span>None</span>';
            //     }
            //     $items = [];
            //     foreach ($visit->sales as $sale) {
            //         if (isset($sale->saleitems) && count($sale->saleitems) > 0) {
            //             foreach ($sale->saleitems as $item) {
            //                 $productName = $item->product->name ?? 'Product';
            //                 $pieces = $item->pieces ?? 0;
            //                 $price = number_format((float)($item->price ?? 0));
            //                 $value = number_format((float)($item->value ?? 0));
            //                 $items[] = "$productName - {$pieces} pcs @ KSh {$price} = KSh {$value}";
            //             }
            //         } else {
            //             $items[] = 'Sale recorded (no items)';
            //         }
            //     }
            //     return '<ul><li>' . implode('</li><li>', array_map('e', $items)) . '</li></ul>';
            // })
            // ->addColumn('followups_list', function ($visit) {
            //     if (!isset($visit->followups) || count($visit->followups) === 0) {
            //         return '<span>None</span>';
            //     }
            //     $items = [];
            //     foreach ($visit->followups as $f) {
            //         $type = ucfirst($f->type ?? 'Followup');
            //         $status = !empty($f->status) ? ucfirst($f->status) : '';
            //         $items[] = trim($type . ($status ? ' - ' . $status : ''));
            //     }
            //     return '<ul><li>' . implode('</li><li>', array_map('e', $items)) . '</li></ul>';
            // })
            // ->addColumn('feedbacks_list', function ($visit) {
            //     if (!isset($visit->feedbacks) || count($visit->feedbacks) === 0) {
            //         return '<span>None</span>';
            //     }
            //     $items = [];
            //     foreach ($visit->feedbacks as $fb) {
            //         $items[] = $fb->feedback ?? '';
            //     }
            //     return '<ul><li>' . implode('</li><li>', array_map('e', $items)) . '</li></ul>';
            // })
            // ->rawColumns(['date', 'time',
            // //  'sales_list', 'followups_list', 'feedbacks_list'
            //  ])
            // ->make(true);


        return DataTables::eloquent($query)
        ->addColumn('date', function ($visit) {
            return $visit->created_at->format('d-M-Y');
        })
        // ->addColumn('team_name', function ($visit) {
        //     return $visit->team ? $visit->team->name : 'None';
        // })
        // ->orderColumn('region_name', 'regions.name $1')
        // ->orderColumn('territory_name', 'territories.name $1')
        // ->orderColumn('team_name', 'teams.name $1')
        // ->orderColumn('user_name', 'users.name $1')
        // ->orderColumn('outlet_name', 'outlets.name $1')
        // ->orderColumn('contactpersonname', 'outlets.contact_person_name $1')
        // ->orderColumn('phone', 'outlets.phone $1')
        // allow searching on region_name
        // ->filterColumn('region_name', function($query, $keyword) {
        //     $query->whereRaw("regions.name like ?", ["%{$keyword}%"]);
        // })
        // ->filterColumn('territory_name', function($query, $keyword) {
        //     $query->whereRaw("territories.name like ?", ["%{$keyword}%"]);
        // })
        // ->filterColumn('team_name', function($query, $keyword) {
        //     $query->whereRaw("teams.name like ?", ["%{$keyword}%"]);
        // })
        // ->filterColumn('user_name', function($query, $keyword) {
        //     $query->whereRaw("users.name like ?", ["%{$keyword}%"]);
        // })
        // ->filterColumn('outlet_name', function($query, $keyword) {
        //     $query->whereRaw("outlets.name like ?", ["%{$keyword}%"]);
        // })
        // ->filterColumn('contactpersonname', function($query, $keyword) {
        //     $query->whereRaw("outlets.contact_person_name like ?", ["%{$keyword}%"]);
        // })
        // ->filterColumn('phone', function($query, $keyword) {
        //     $query->whereRaw("outlets.phone like ?", ["%{$keyword}%"]);
        // })
        ->addColumn('time', function ($visit) {
            return $visit->created_at->format('H:i:s');
        })
            ->addColumn('sales_list', function ($visit) {
                if (!isset($visit->sales) || count($visit->sales) === 0) {
                    return '<span>None</span>';
                }
                $items = [];
                foreach ($visit->sales as $sale) {
                    if (isset($sale->saleitems) && count($sale->saleitems) > 0) {
                        foreach ($sale->saleitems as $item) {
                            $productName = $item->product->name ?? 'Product';
                            $pieces = $item->pieces ?? 0;
                            $price = number_format((float)($item->price ?? 0));
                            $value = number_format((float)($item->value ?? 0));
                            $items[] = "$productName - {$pieces} pcs @ KSh {$price} = KSh {$value}";
                        }
                    } else {
                        $items[] = 'Sale recorded (no items)';
                    }
                }
                return '<ul><li>' . implode('</li><li>', array_map('e', $items)) . '</li></ul>';
            })
            ->addColumn('followups_list', function ($visit) {
                if (!isset($visit->followups) || count($visit->followups) === 0) {
                    return '<span>None</span>';
                }
                $items = [];
                foreach ($visit->followups as $f) {
                    $type = ucfirst($f->type ?? 'Followup');
                    $status = !empty($f->status) ? ucfirst($f->status) : '';
                    $items[] = trim($type . ($status ? ' - ' . $status : ''));
                }
                return '<ul><li>' . implode('</li><li>', array_map('e', $items)) . '</li></ul>';
            })
            ->addColumn('feedbacks_list', function ($visit) {
                if (!isset($visit->feedbacks) || count($visit->feedbacks) === 0) {
                    return '<span>None</span>';
                }
                $items = [];
                foreach ($visit->feedbacks as $fb) {
                    $items[] = $fb->feedback ?? '';
                }
                return '<ul><li>' . implode('</li><li>', array_map('e', $items)) . '</li></ul>';
            })
        ->rawColumns(['date','time','sales_list', 'followups_list', 'feedbacks_list'])
        ->make(true);


        }

public function export(Request $request)
{
    $filters = [
        'search' => $request->input('search.value'),
        'columns' => [],
        'dateFrom' => $request->input('dateFrom'),
        'dateTo' => $request->input('dateTo'),
        'timeFrom' => $request->input('timeFrom'),
        'timeTo' => $request->input('timeTo'),
    ];

    // Build a dynamic column map from the DataTables payload
    $columnMap = [];
    foreach ($request->input('columns', []) as $index => $col) {
        $key = $col['data'] ?? $col['name'] ?? null;
        if (!$key) continue;

        // sanitize key: allow letters, numbers, dot, underscore only
        // prevents injection like "users.name; DROP TABLE..."
        if (!preg_match('/^[a-z0-9_.]+$/i', $key)) continue;

        $columnMap[$index] = $key;
    }

    // Collect any per-column searches (ignore action-like columns by name)
    foreach ($request->input('columns', []) as $index => $col) {
        $searchVal = $col['search']['value'] ?? null;
        if (trim((string)$searchVal) === '') continue;

        $mapped = $columnMap[$index] ?? null;
        if (!$mapped) continue;

        // optional: ignore UI columns named "actions"
        if (stripos($mapped, 'action') !== false) continue;

        // Save as-is — later exported class should use bindings when applying filters
        $filters['columns'][$mapped] = $searchVal;
    }

    // return Excel::download(new VisitsExportDatatables($filters), 'visits.xlsx');
    $export = new VisitsExportDatatables($filters);

        // store in local disk (storage/app/exports) via queue
    // $filename = 'exports/visits_' . now()->format('Ymd_His') . '.xlsx';
    // Excel::queue($export, $filename, 'local');

    $filename = 'exports/visits_' . now()->format('Ymd_His') . '.xlsx';
    Excel::queue($export, $filename, 'public');

    // Build the public URL (will work after the job finishes)
// $publicUrl = Storage::disk('public')->$request->url($filename);

// return back()->with('success', "Export started. The file will be available here: <a href='{$publicUrl}' target='_blank'>{$publicUrl}</a>");


    return back()->with('success', 'Export started. The file will be available when the queue job finishes.');


}




        public function showVisitsById($objectId,$object) {
            //$visits = Visit::all();
            $visits = Visit::with(['user' => function ($query) {
                $query->withTrashed();
            },'outlet' => function ($query) {
                $query->withTrashed();
            }, 'followups', 'sales.saleitems.product', 'feedbacks'])
            ->where($object.'_id',$objectId)->get();
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

        public function filterVisitsAnalytics(Request $request) {
            //$visits = Visit::all();
            $query = Visit::with(['user' => function ($query) {
                $query->withTrashed();
            }, 'outlet']);

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

            $visitcount = (clone $query)->count();

            $querysales = Sale::with(['visit']);

            if ($request->from_time) {
                $querysales->whereRaw("TIME(created_at) >= ?", [$request->from_time]);
                }
                if ($request->to_time) {
                    $querysales->whereRaw("TIME(created_at) <= ?", [$request->to_time]);
                }

                if ($request->from_date) {
                    $querysales->whereDate('created_at', '>=', $request->from_date);
                }

                if ($request->to_date) {
                    $querysales->whereDate('created_at', '<=', $request->to_date);
                }

            $salescount = (clone $querysales)->count();

            $salespervisit = $visitcount > 0 ? round(($salescount / $visitcount), 2) : 0;
            $salespervisit = $salespervisit;

            $visitsWithSales = (clone $querysales)
            ->distinct('visit_id')->count('visit_id');

            $salesconversionrate = $visitcount > 0 ? round(($visitsWithSales / $visitcount) * 100) : 0;
            $salesconversionrate = $salesconversionrate.' %';


            $visitcounttill8 = (clone $query)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<', '08:00:00')
            ->count();
            $visitcounttill16 = (clone $query)
            ->whereTime('created_at', '>=', '08:00:00')
            ->whereTime('created_at', '<', '16:00:00')
            ->count();
            $visitcounttill24 = (clone $query)
            ->whereTime('created_at', '>=', '16:00:00')
            ->whereTime('created_at', '<', '24:00:00')
            ->count();
            $visitwithoutcheckout = (clone $query)
            ->where('checkout_time', '=', '')
            ->count();
            $visitbeyond5min = (clone $query)
            //(checkout_time-checkin time)/60
            ->where('duration', '>=', '00:05:00')
            ->count();
            $visitbelow5min = (clone $query)
            //(checkout_time-checkin time)/60
            ->where('duration', '<=', '00:05:00')
            ->count();
            $visitfirst = (clone $query)->first();
            $visitfirst =$visitfirst ? (date('H:i', strtotime($visitfirst['created_at']))) :'N/A';
            $visitlast =  (clone $query)->orderBy('created_at', 'desc')->first();
            $visitlast =$visitlast ? (date('H:i', strtotime($visitlast['created_at']))) :'N/A';

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
            $visitsPerDayFiltered = array();
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
                $visitsPerDayFiltered[$dateStringFiltered] = Visit::whereDate('created_at', $dateStringFiltered)->count();
            }

            $visitsPerDayFiltered = array_reverse($visitsPerDayFiltered);
            $datesFiltered = array_reverse($datesFiltered);
            $dayNamesFiltered = array_reverse($dayNamesFiltered);


            //$users = User::inOrganization()->where('usertype','seller')->get();
            return response()->json(compact(
            'visitcount','visitcounttill8','visitcounttill16','visitcounttill24','salespervisit',
            'salesconversionrate',
            'visitwithoutcheckout','visitbeyond5min','visitbelow5min','visitfirst','visitlast',
            'visitsPerDayFiltered','datesFiltered','dayNamesFiltered'
            ) );
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

            $datesFiltered = [];
            $dayNamesFiltered = [];
            $visitsPerDayFiltered = array();
            for ($i = 1; $i <= 1; $i++) {

                // ->subDays($i)
                $dateFiltered = now();
                $dateStringFiltered = $dateFiltered->toDateString();
                $dayNameFiltered = $dateFiltered->format('l'); // Get the day name (e.g., 'Monday')

                $datesFiltered[] = $dateStringFiltered;
                $dayNamesFiltered[] = $dayNameFiltered;

                // ->subDays($i)
                $dateFiltered = now()->toDateString();


                $visitsPerDayFiltered[$dateFiltered] = Visit::whereDate('created_at', $dateFiltered)->count();
            }
            $visitsPerDayFiltered = array_reverse($visitsPerDayFiltered);
            $datesFiltered = array_reverse($datesFiltered);
            $dayNamesFiltered = array_reverse($dayNamesFiltered);


            $visitsData = Visit::join('users', 'visits.user_id', '=', 'users.id')
            ->join('regions', 'users.region_id', '=', 'regions.id')
            // ->select(DB::raw('COALESCE(regions.name, "Unknown Region") as region_name'), DB::raw('COUNT(sales.id) as total_sales_count'))
            ->select(DB::raw('COALESCE(regions.name, "Region not assigned") as region_name'), DB::raw('COUNT(visits.id) as total_visits_count'))
            ->groupBy('regions.name')
            ->get();

            // Extracting two separate arrays
            $regionNames = $visitsData->pluck('region_name')->toArray();
            $totalVisits = $visitsData->pluck('total_visits_count')->toArray();





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


            $visitcount = Visit::whereDate('created_at', Carbon::today())->count();
            $salescount = Sale::whereDate('created_at', Carbon::today())->count();

            $salespervisit = $visitcount > 0 ? round(($salescount / $visitcount), 2) : 0;
            $salespervisit = $salespervisit;



            $visitsWithSales = \App\Models\Sale::whereDate('created_at', Carbon::today())
            ->distinct('visit_id')->count('visit_id');

            $salesconversionrate = $visitcount > 0 ? round(($visitsWithSales / $visitcount) * 100) : 0;
            $salesconversionrate = $salesconversionrate.' %';

            $visitcounttill8 = Visit::whereDate('created_at', Carbon::today())
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<', '08:00:00')
            ->count();
            $visitcounttill16 = Visit::whereDate('created_at', Carbon::today())
            ->whereTime('created_at', '>=', '08:00:00')
            ->whereTime('created_at', '<', '16:00:00')
            ->count();
            $visitcounttill24 = Visit::whereDate('created_at', Carbon::today())
            ->whereTime('created_at', '>=', '16:00:00')
            ->whereTime('created_at', '<', '24:00:00')
            ->count();
            $visitwithoutcheckout = Visit::whereDate('created_at', Carbon::today())
            ->where('checkout_time', '=', '')
            ->count();
            $visitbeyond5min = Visit::whereDate('created_at', Carbon::today())
            //(checkout_time-checkin time)/60
            ->where('duration', '>=', '00:05:00')
            ->count();
            $visitbelow5min = Visit::whereDate('created_at', Carbon::today())
            //(checkout_time-checkin time)/60
            ->where('duration', '<=', '00:05:00')
            ->count();
            $visitfirst = Visit::whereDate('created_at', Carbon::today())->first();
            $visitfirst =$visitfirst ? (date('H:i', strtotime($visitfirst['created_at']))) :'N/A';
            $visitlast =  Visit::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->first();
            $visitlast =$visitlast ? (date('H:i', strtotime($visitlast['created_at']))) :'N/A';


            $topSellersGraph = Visit::join('users', 'users.id', '=', 'visits.user_id')
            ->select('visits.user_id', 'users.name', DB::raw('COUNT(visits.user_id) as count'))
            ->groupBy('visits.user_id', 'users.name')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

            $topSellerUserNames = $topSellersGraph->pluck('name')->toArray();
            $topSellerVisitsCount = $topSellersGraph->pluck('count')->toArray();

            //$users = User::inOrganization()->where('usertype','seller')->get();
            return view('visit.analytics', compact('visitsPerMonth','visits','users','outlets','months','visitsCount',
            'visitsThisMonth', 'visitsThisWeek','visitsToday','visitsPerDay','dates','dayNames',
            'visitcount','visitcounttill8','visitcounttill16','visitcounttill24','visitfirst','visitlast',
            'visitbeyond5min','visitwithoutcheckout','visitbelow5min','salespervisit','salesconversionrate',
            'visitsPerDayFiltered','datesFiltered','dayNamesFiltered','regionNames','totalVisits','topSellerUserNames',
            'topSellerVisitsCount') );
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
            public function tempCalculateDurations(){

            // $visits = Visit::where('user_id','=',1)->get();
             $visits = Visit::all();
            $results = '';
            foreach($visits as $visit){

                if(strlen($visit->checkout_time)>0){
                $timestamp1 = (int)$visit->checkout_time;
                $timestamp2 = (int)$visit->checkin_time;

                // Calculate the time difference in seconds
                $timeDifferenceInSeconds = $timestamp1 - $timestamp2;

                // Convert to H:i:s format
                $timeDifference = gmdate('H:i:s', $timeDifferenceInSeconds);

                $visit->duration = $timeDifference;

                $createdAt = Carbon::parse($visit->created_at);
                $modifiedTime = $createdAt->copy()->addSeconds($timeDifferenceInSeconds);

                // Get only the time in HH:MM:SS format
                $timeOnly = $modifiedTime->format('H:i:s');

                $visit->checkouttimeexact = $timeOnly;

            }else{
                // $visit->duration = "";
            }

                $visit->save();
                $results .= $visit['id'].$createdAt.' '.$modifiedTime.' '.$timeDifference.'<br>';
            }

            return $results;

        }

}
