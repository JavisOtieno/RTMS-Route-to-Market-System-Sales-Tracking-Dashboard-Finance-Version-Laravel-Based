<?php

namespace App\Http\Controllers;

use App\Models\Followup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FollowupController extends Controller
{
    //
    public function index() {
        //$followup = Followup::all();
        $followups = Followup::with(['user' => function ($query) {
            $query->withTrashed();
        },'outlet','team'])->get();
        return view('followup.index', ['followups'=>$followups]);
    }

    public function showFollowupById($id,$object) {
        //$followup = Followup::all();
            // Check if the object is 'clockin'
    if ($object === 'clockin') {
        // Fetch followup based on clockin ID via visits
        $followup = Followup::whereHas('visit', function ($query) use ($id) {
            $query->where('clockin_id', $id);
        })->with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
    } else{
        $followup = Followup::with(['user' => function ($query) {
            $query->withTrashed();
        }])->where($object.'_id',$id)->get();
    }
        return view('followup.show', ['followup'=>$followup]);
    }


    public function deleteFollowup($id){
        $followup = Followup::find($id);
        $followup->delete();
        return redirect('/followups');
    }
    public function showEditFollowup($id){
        //$followup = Followup::find($id);
        $followup = Followup::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get()->find($id);
        return view('followup.edit',['followup'=>$followup]);
    }

    public function saveEditFollowup($id, Request $request){

        // $organization_id=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'description'=>'required|string|max:3000',
            'type'=>'required|string|max:255',
            'status'=>'required|string|max:255',
            'date'=>'required|string|max:255',
            'time'=>'required|string|max:255', 
        ]);

        $incomingFields['description']=strip_tags($request['description']);
        $incomingFields['type']=strip_tags($request['type']);
        $incomingFields['status']=strip_tags($request['status']);
        $incomingFields['date']=strip_tags($request['date']);
        $incomingFields['time']=strip_tags($request['time']);
        $incomingFields['organization_id']=auth()->user()->organization_id;
        $incomingFields['team_id']=auth()->user()->team_id;
        // $incomingFields['organization_id']=$organization_id;
        
        $followup=Followup::find($id);

        $followup->update($incomingFields);

        return redirect('/followups');
        
    }

            public function followupsYajra(Request $request)
    {
       
        $followups = Followup::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
        // return DataTables::of($followups)->make(true);
        $query = Followup::select(
            'followups.*',
            // DB::raw("DATE_FORMAT(followups.created_at, '%d-%b-%Y') as date"),
            // DB::raw("DATE_FORMAT(followups.created_at, '%H:%i:%s') as time"),
            // DB::raw("DATE_FORMAT(FROM_UNIXTIME(followups.checkout_time), '%H:%i:%s') as checkout_time"),
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
        ->leftJoin('outlets', 'outlets.id', '=', 'followups.outlet_id')
        // ->leftJoin('channel_types', 'channel_types.id', '=', 'outlets.channel_type_id')
        ->leftJoin('users', 'users.id', '=', 'followups.user_id')

        // skjdjkjfjhsjkhdfks
        ->leftJoin('teams', 'teams.id', '=', 'followups.team_id')
        // ->leftJoin('regions', 'regions.id', '=', 'users.region_id')
        // ->leftJoin('territories', 'territories.id', '=', 'users.territory_id')
        // ->leftJoin('clusters', 'clusters.id', '=', 'users.cluster_id')
        // ->leftJoin('sale_items', 'sale_items.sale_id', '=', 'followups.id')
        // ->leftJoin('products', 'products.id', '=', 'sale_items.product_id')
        // ->groupBy('followups.id')
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
            $query->whereRaw("TIME(followups.created_at) >= ?", [$request->from_time]);
            }
            if (!empty($request->to_time)) {
                $query->whereRaw("TIME(followups.created_at) <= ?", [$request->to_time]);
            }
        
            if (!empty($request->from_date)) {
                $query->whereDate('followups.created_at', '>=', $request->from_date);
            }
        
            if (!empty($request->to_date)) {
                $query->whereDate('followups.created_at', '<=', $request->to_date);
            }
        // $followups = $query->get();
        
        // ->join('outlets', 'outlets.id', '=', 'followups.outlet_id')
        // ->get();
        // return DataTables::of($followups)
        return DataTables::eloquent($query)
        ->addColumn('date', function ($followups) {
            return $followups->created_at->format('d-M-Y'); // Extract Date
        })     

        ->addColumn('time', function ($followups) {
            return $followups->created_at->format('H:i:s'); // Extract Time
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

    public function indexFollowupsYajra()
    {
        return view('followup.indexyajra');
    }

}
