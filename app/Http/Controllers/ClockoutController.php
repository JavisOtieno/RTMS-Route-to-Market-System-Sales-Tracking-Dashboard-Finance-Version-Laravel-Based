<?php

namespace App\Http\Controllers;

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

        // public function showEditClockout(Request $request){
        //     $incomingFields=$request->validate([
        //         'id'=>'required|numeric|digits_between:1,11'
        //     ]);
        //     $clockout = Clockout::find($incomingFields['id']);
        //     return view('edit-clockout',['clockout'=>$clockout]);
        // }

}
