<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use App\Models\Clockin;
use Illuminate\Http\Request;
use App\Mail\ReportSenderTest;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class ClockinController extends Controller

//test
{
    //
    public function apiindex(){
        $clockins = Clockin::all();
        return response()->json(['clockins'=>$clockins]);
    }
    public function index() {
        //$clockins = Clockin::all();
        $clockins = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();

        // $clockin = Clockin::first();
        //     Mail::to('javisotieno@gmail.com',
        //     // 'Technology@scgafrica.com','stanley@scgafrica.com'
        //     )->send(new ReportSenderTest($clockin));

        return view('clockin.index', ['clockins'=>$clockins]);
    }
    public function indexVisitsYajra() {
            return view('clockin.indexyajravisits');
    }
        public function clockinsVisitsYajra(Request $request)
{
        $withRelations = ['user' => function($q){ $q->withTrashed(); }, 'clockout' => function($q){ $q->withTrashed(); }, 'visits.outlet'];

    $query = Clockin::with($withRelations)
        ->select('clockins.*', 'users.name as user_name', 'outlets.name as outlet_name', 'outlets.contact_person_name as contactpersonname', 'outlets.phone as phone')
        ->leftJoin('users', 'users.id', '=', 'clockins.user_id')
        ->leftJoin('visits', 'visits.clockin_id', '=', 'clockins.id')
        ->leftJoin('outlets', 'outlets.id', '=', 'visits.outlet_id')
        ->groupBy('clockins.id'); // avoid duplicate rows when joins produce multiple visits

    // apply same filters you had (date/time)
    if (!empty($request->from_date)) $query->whereDate('clockins.created_at', '>=', $request->from_date);
    if (!empty($request->to_date)) $query->whereDate('clockins.created_at', '<=', $request->to_date);
    if (!empty($request->from_time)) $query->whereRaw("TIME(clockins.created_at) >= ?", [$request->from_time]);
    if (!empty($request->to_time)) $query->whereRaw("TIME(clockins.created_at) <= ?", [$request->to_time]);

    return DataTables::eloquent($query)
        ->addColumn('date', fn($row) => optional($row->created_at)->format('d-M-Y'))
        ->addColumn('time', fn($row) => optional($row->created_at)->format('H:i'))
        ->addColumn('name', function($row){
            return $row->user ? $row->user->name . ($row->user->trashed() ? ' (Deleted User)' : '') : 'Deleted User';
        })
        ->addColumn('map', function($row){
            // encode the whole row array safely into data-row attribute
            $json = rawurlencode(json_encode($row->toArray()));
            return '<button class="btn btn-success open-map-btn" data-row="'.$json.'" type="button">Map</button>';
        })
        ->rawColumns(['map'])
        ->make(true);
}
    public function showClockinsById($objectId,$object) {
        //$clockins = Clockin::all();
        $clockins = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }])->where($object.'_id',$objectId)->get();

        return view('clockin.index', ['clockins'=>$clockins]);
    }
    public function showEditClockin($id){
        // $clockin = Clockin::find($id);
        $clockin = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get()->find($id);
        return view('clockin.edit',['clockin'=>$clockin]);
    }
    public function showClockinsMap(){
        $clockins = Clockin::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();


        $users = User::inOrganization()->where('usertype','seller')->get();
   
        return view('clockin.map', compact('clockins','users') );
    }
    // public function showEditClockin(Request $request){
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $clockin = Clockin::find($incomingFields['id']);
    //     return view('edit-clockin',['clockin'=>$clockin]);
    // }
        public function filterClockins(Request $request) {
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
        return response()->json(['clockins'=>$clockins]);
    }
}
