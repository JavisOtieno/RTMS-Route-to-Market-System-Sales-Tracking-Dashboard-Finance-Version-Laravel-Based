<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    //

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
        $users = User::all();
        return view('add-outlet',['users'=>$users]);
    }
    public function saveOutlet(Request $request){

       
        $incomingFields=$request->validate([
            'userId'=>'required|numeric|digits_between:1,11',
            'name'=>'required|string|max:255',
            'contactName'=>'required|string|max:255',
            'phone'=>'required|string|max:255',
            'lat'=>'required|between:-90.000000000,90.000000000',
            'long'=>'required|between:-180.000000000,180.000000000',
            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        
        $incomingFields['user_id']=strip_tags($incomingFields['userId']);
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['contact_person_name']=strip_tags($incomingFields['contactName']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['lat']=strip_tags($incomingFields['lat']);
        $incomingFields['long']=strip_tags($incomingFields['long']);
        //$incomingFields['image']='';

        if($request['image']){

            $imageName = time().'.'.$request->image->extension();

            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            // Save image to public/images directory
            //$request->image->move(public_path('images'), $imageName);
    
            //code from android version
            $folder="outlets";
            $imagePath=$folder."/".$imageName;
            //Storage::disk('public')->put($imagePath, $imageData);
            $incomingFields['image']=$imagePath;
    
            //store using the storage facade
            //stores to images/folder in this case images/products/
            //$path = $request->file('image')->storeAs('images', $imagePath, 'public');
            //$path = $request->file('image')->storeAs('images', $imagePath, 'public');
    
            //store to products
            $path = $request->file('image')->storeAs($folder, $imageName, 'public');
            
        }else{
            $incomingFields['image']='';   
        }

        Outlet::create($incomingFields);

        return redirect('/outlets');
        
    }
    public function showEditOutlet($id){
        $outlet = Outlet::find($id);
        return view('edit-outlet',compact('outlet'));
    }
    public function saveEditOutlet($id, Request $request){
        $incomingFields=$request->validate([
            'userId'=>'required|numeric|digits_between:1,11',
            'name'=>'required|string|max:255',
            'contactPersonName'=>'required|string|max:255',
            'phone'=>'required|string|max:255',
            'lat'=>'required|between:-90.000000000,90.000000000',
            'long'=>'required|between:-180.000000000,180.000000000'
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
