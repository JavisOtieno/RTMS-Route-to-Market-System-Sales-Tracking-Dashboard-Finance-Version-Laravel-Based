<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    //
    public function apiindex(){
        $outlets = Outlet::all();
        return response()->json(['outlets'=>$outlets]);
    }
    public function index() {
        $outlets = Outlet::all();
        return view('outlets', ['outlets'=>$outlets]);
    }
    public function deleteOutlet($id){
        $outlet = Outlet::find($id);
        $outlet->delete();
        return redirect('/outlets');
    }
    public function addOutlet() {
        return view('add-outlet');
    }
    public function saveOutlet(Request $request){

       
        $incomingFields=$request->validate([
            'userId'=>'required',
            'name'=>'required',
            'contactName'=>'required',
            'phone'=>'required',
            'lat'=>'required',
            'long'=>'required'
        ]);
        
        $incomingFields['user_id']=strip_tags($incomingFields['userId']);
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['contact_person_name']=strip_tags($incomingFields['contactName']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['lat']=strip_tags($incomingFields['lat']);
        $incomingFields['long']=strip_tags($incomingFields['long']);

        Outlet::create($incomingFields);

        return redirect('/outlets');
        
    }
    public function showEditOutlet($id){
        $outlet = Outlet::find($id);
        return view('edit-outlet',['outlet'=>$outlet]);
    }
    public function saveEditOutlet($id, Request $request){
        $incomingFields=$request->validate([
            'userId'=>'required',
            'name'=>'required',
            'contactPersonName'=>'required',
            'phone'=>'required',
            'lat'=>'required',
            'long'=>'required'
        ]);

        $incomingFields['user_id']=strip_tags($incomingFields['userId']);
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['contact_person_name']=strip_tags($incomingFields['contactPersonName']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['lat']=strip_tags($incomingFields['lat']);
        $incomingFields['long']=strip_tags($incomingFields['long']);

        $outlet=Outlet::find($id);

        $outlet->update($incomingFields);

        return redirect('/outlets');
        
    }
}
