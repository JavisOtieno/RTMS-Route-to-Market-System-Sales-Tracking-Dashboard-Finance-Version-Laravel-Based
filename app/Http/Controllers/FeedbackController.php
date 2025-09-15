<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Imports\ImportFeedback;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class FeedbackController extends Controller
{
    //
    public function apiindex(){
        $feedback = Feedback::all();
        return response()->json(['feedback'=>$feedback]);
    }
    
    public function index() {
        //$feedback = Feedback::all();
        $feedback = Feedback::with(['user' => function ($query) {
            $query->withTrashed();
        },
        'outlet' => function ($query) {
            $query->withTrashed();
        },
        'outlet.region',        // <--- eager load region
        'outlet.territory',     // <--- eager load territory
        'team', 
        ])->get();
        return view('feedback', ['feedback'=>$feedback]);
    }

    public function showFeedbackById($id,$object) {
        //$feedback = Feedback::all();
            // Check if the object is 'clockin'
    if ($object === 'clockin') {
        // Fetch feedback based on clockin ID via visits
        $feedback = Feedback::whereHas('visit', function ($query) use ($id) {
            $query->where('clockin_id', $id);
        })->with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
    } else{
        $feedback = Feedback::with(['user' => function ($query) {
            $query->withTrashed();
        }])->where($object.'_id',$id)->get();
    }
        return view('feedback', ['feedback'=>$feedback]);
    }


    public function deleteFeedback($id){
        $feedback = Feedback::find($id);
        $feedback->delete();
        return redirect('/feedback');
    }
    public function showEditFeedback($id){
        //$feedback = Feedback::find($id);
        $feedback = Feedback::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get()->find($id);
        return view('edit-feedback',['feedback'=>$feedback]);
    }

    public function showAddFeedback($id){
        //$feedback = Feedback::find($id);
        $visit = Visit::with(['outlet','user' => function ($query) {
            $query->withTrashed();
        }])->get()->find($id);
        return view('feedback.add',['visit'=>$visit]);
    }


    public function saveEditFeedback($id, Request $request){

        // $organization_id=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'feedback' => 'required',
        ]);

        $incomingFields['feedback']=strip_tags($incomingFields['feedback']);
        // $incomingFields['organization_id']=$organization_id;
        
        $feedback=Feedback::find($id);

        $feedback->update($incomingFields);

        return redirect('/feedback');
        
    }
    public function importView(Request $request){
        return view('importFile');
    }

    public function import(Request $request){

        Excel::import(new ImportFeedback, 
                      $request->file('file')->store('files'));
        return redirect()->back();

        // Store the file and get the relative path
        // $path = $request->file('file')->store('files');

        // // Get the full path of the file from storage
        // $fullPath = storage_path('app/' . $path);

        // // Import the file
        // Excel::import(new ImportRoute, $fullPath);

        // return redirect()->back();
    
    }

    public function saveFeedback(Request $request){

        // $organization_id=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'user_id'=>'required|numeric|digits_between:1,20|exists:users,id',
            'visit_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            'outlet_id'=>'required|numeric|digits_between:1,20|exists:outlets,id',
            'feedback' => 'required',
        ]);

        $incomingFields['feedback']=strip_tags($incomingFields['feedback']);
        // $visit_id = strip_tags($incomingFields['visit_id']);
        $visit = Visit::find($incomingFields['visit_id']);
        // $incomingFields['organization_id']=$organization_id;

        $incomingFields['organization_id']=$visit->organization_id;
        $incomingFields['team_id']=$visit->team_id;
        // $incomingFields['created_at']=$visit->created_at;
        function durationToSeconds(?string $duration): int
        {
            if (empty($duration)) {
                return -1; // signal "null/empty"
            }

            $parts = array_reverse(explode(':', trim($duration)));
            $seconds = 0;

            if (isset($parts[0])) $seconds += (int) $parts[0];          // seconds
            if (isset($parts[1])) $seconds += (int) $parts[1] * 60;     // minutes
            if (isset($parts[2])) $seconds += (int) $parts[2] * 3600;   // hours

            return $seconds;
        }

        $durationSeconds = durationToSeconds($visit->duration);

        if ($durationSeconds === -1) {
            // null or empty → use max = 2 minutes
            $randSeconds = random_int(1, 120);
        } elseif ($durationSeconds === 0) {
            // duration = zero → add 0 seconds
            $randSeconds = 0;
        } else {
            // duration > 0 → pick between 1 and that duration
            $randSeconds = random_int(1, $durationSeconds);
        }

        // $incomingFields['created_at'] = $visit->created_at->copy()->addSeconds($randSeconds);
        // $incomingFields['updated_at'] = $visit->created_at->copy()->addSeconds($randSeconds);


        $feedback = Feedback::create($incomingFields);

        $incomingFields2['created_at'] = $visit->created_at->copy()->addSeconds($randSeconds);
        $incomingFields2['updated_at'] = $visit->created_at->copy()->addSeconds($randSeconds);
        $feedback->update($incomingFields2);

        return redirect('/feedback');
        
    }
    
    // public function showEditFeedback(Request $request){
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $feedback = Feedback::find($incomingFields['id']);
    //     return view('edit-feedback',['feedback'=>$feedback]);
    // }

        public function feedbackYajra(Request $request)
    {
       
        $feedback = Feedback::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
        // return DataTables::of($feedback)->make(true);
        $query = Feedback::select(
            'feedback.*',
            // DB::raw("DATE_FORMAT(feedback.created_at, '%d-%b-%Y') as date"),
            // DB::raw("DATE_FORMAT(feedback.created_at, '%H:%i:%s') as time"),
            // DB::raw("DATE_FORMAT(FROM_UNIXTIME(feedback.checkout_time), '%H:%i:%s') as checkout_time"),
            // 'regions.name as region_name',
            // 'territories.name as territory_name',
            // 'clusters.name as cluster_name',
            // 'channel_types.name as channel_type_name',

            'teams.name as team_name',
            'users.name as user_name',
            'outlets.name as outlet_name',

            // 'outlets.contact_person_name as contactpersonname',
            // 'outlets.phone as phone',
            // DB::raw("GROUP_CONCAT(CONCAT(products.name, ' (', sale_items.pieces, ')') SEPARATOR ', ') as product_info")

            
        )
        ->leftJoin('outlets', 'outlets.id', '=', 'feedback.outlet_id')
        // ->leftJoin('channel_types', 'channel_types.id', '=', 'outlets.channel_type_id')
        ->leftJoin('users', 'users.id', '=', 'feedback.user_id')

        // skjdjkjfjhsjkhdfks
        ->leftJoin('teams', 'teams.id', '=', 'feedback.team_id')
        // ->leftJoin('regions', 'regions.id', '=', 'users.region_id')
        // ->leftJoin('territories', 'territories.id', '=', 'users.territory_id')
        // ->leftJoin('clusters', 'clusters.id', '=', 'users.cluster_id')
        // ->leftJoin('sale_items', 'sale_items.sale_id', '=', 'feedback.id')
        // ->leftJoin('products', 'products.id', '=', 'sale_items.product_id')
        // ->groupBy('feedback.id')
        ;

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
        if (!empty($request->from_time)) {
            $query->whereRaw("TIME(feedback.created_at) >= ?", [$request->from_time]);
            }
            if (!empty($request->to_time)) {
                $query->whereRaw("TIME(feedback.created_at) <= ?", [$request->to_time]);
            }
        
            if (!empty($request->from_date)) {
                $query->whereDate('feedback.created_at', '>=', $request->from_date);
            }
        
            if (!empty($request->to_date)) {
                $query->whereDate('feedback.created_at', '<=', $request->to_date);
            }
        // $feedback = $query->get();
        
        // ->join('outlets', 'outlets.id', '=', 'feedback.outlet_id')
        // ->get();
        // return DataTables::of($feedback)
        return DataTables::eloquent($query)
        ->addColumn('date', function ($feedback) {
            return $feedback->created_at->format('d-M-Y'); // Extract Date
        })     

        ->addColumn('time', function ($feedback) {
            return $feedback->created_at->format('H:i:s'); // Extract Time
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

    public function indexFeedbackYajra()
    {
        return view('feedback.indexyajra');
    }

}
