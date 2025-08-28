<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Visit;
use App\Models\Outlet;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

        $outlets = $query->get();
        // return DataTables::of($outlets)->make(true);
        return DataTables::of($outlets)
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
        return view('outletsyajratest');
    }
    //

    public function index() {
        // $outlets = Outlet::all();
        $outlets = Outlet::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
        return view('outlet.index', ['outlets'=>$outlets]);
        
    }

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
