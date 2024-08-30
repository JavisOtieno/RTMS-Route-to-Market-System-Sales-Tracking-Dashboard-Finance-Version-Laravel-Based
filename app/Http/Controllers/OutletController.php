<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Visit;
use App\Models\Outlet;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class OutletController extends CommonController
{

    public function ajaxOutletsYajraTest()
    {
        $outlets = Outlet::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
        return DataTables::of($outlets)->make(true);

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
        $outlet = Outlet::find($id);
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
        
        

        $outlet=Outlet::find($id);

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
