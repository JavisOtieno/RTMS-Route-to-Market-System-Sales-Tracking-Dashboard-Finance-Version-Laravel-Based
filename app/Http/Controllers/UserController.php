<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use App\Rules\PhoneNumber;
use App\Models\TargetGroup;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends CommonController
{
    //
    //test commit github
    public function apiindex(){
        //$sales = Sale::all();
        $users = User::inOrganization()->get();
        return response()->json(['users'=>$users]);
    }
    public function admins() {
        $users = User::inOrganization()->with('targetgroup')->where('usertype','admin')->get();

        //return $users;
        //dd($sales);
        // $targetgroups = TargetGroup::all();
        return view('admins', ['users'=>$users]);
    }
    public function sellers() {
        $users = User::inOrganization()->with('targetgroup')->where('usertype','seller')->get();

        //return $users;
        //dd($sales);
        $targetgroups = TargetGroup::withTrashed();
        return view('sellers', ['users'=>$users, 'targetgroups'=>$targetgroups]);
    }

    public function showAddUsersToTargetGroups() {
        $users = User::inOrganization()->where('usertype','seller')->get();
        $targetgroups = TargetGroup::all();
        //dd($sales);
        return view('add-users-to-target-group', compact('users','targetgroups') );
    }
    public function addUsersToTargetGroup(Request $request) {

        //return $request;
       
        $incomingFields=$request->validate([
            'target_group_id' => 'required|numeric|digits_between:1,20',
            'usercheckboxes' => 'required|array|min:1',
    ],[
        'usercheckboxes.required' => 'You must select at least one seller.',
        'usercheckboxes.min' => 'You must select at least one seller.',
    ]);
    
    //    $selectedUsers = $request->input('users', []);
                
        $selectedUsers = $request->input('usercheckboxes', []);
        

        // Process the selected items
        foreach ($selectedUsers as $selectedUserId) {
            $user = User::inOrganization()->find($selectedUserId);
            $user->update($incomingFields);
           
            // Perform your processing here
            // For example, you can mark the item as processed, delete it, etc.
        }
        
        return redirect('/adduserstotargetgroups');
        //dd($sales);
        //return view('add-users-to-target-group', compact('users','targetgroups') );
    }
    
    public function deleteSeller($id){
        $user = User::inOrganization()->where('usertype','seller')->find($id);
        $user->delete();
        return redirect('/sellers');
    }


    public function deleteAdmin($id){
        $user = User::inOrganization()->where('usertype','admin')->find($id);
        $user->delete();
        return redirect('/admins');
    }
    public function saveAdmin(Request $request){
        $organizationId=auth()->user()->organization_id;
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','min:10','string','max:255', new PhoneNumber],
            // 'usertype'=>'required|string|max:255',
            'email'=>'required|email|unique:users|max:255',
            //'password'=>'required|string|max:255|min:8|confirmed',
            'password' => ['required','string','max:255','min:8','confirmed',Password::min(8)->letters()->numbers()],
            // 'target_group_id'=>'required|numeric|digits_between:1,11'
        ]);
        //return $incomingFields;
        
        
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['usertype']='admin';
        $incomingFields['target_group_id']=0;
        $incomingFields['region_id']=0;
        $incomingFields['territory_id']=0;
        $incomingFields['email']=strip_tags($incomingFields['email']);
        $incomingFields['password']=strip_tags($incomingFields['password']);
        $incomingFields['organization_id']=$organizationId;
        

        //return $incomingFields['usertype'];

        if($request['image']){

            $imageName = time().'.jpg';

            // Save image to public/images directory
            //$request->image->move(public_path('images'), $imageName);
    
            //code from android version
            $folder="users";
            $imagePathOnDB=$folder."/".$imageName;
            //Storage::disk('public')->put($imagePath, $imageData);
            $incomingFields['image']=$imagePathOnDB;
    
            $image = $request->file('image');
            $imagePath = $image->getPathName();

            $compressedImagePath = storage_path('app/public/users/'.$imageName);

            $sourcePath = $imagePath;
            $maxSizeKB = 100;
            $destinationPath = $compressedImagePath;

            $this->compressImage($sourcePath,$destinationPath,$maxSizeKB);
            
        }else{
            $incomingFields['image']='';   
        }

        User::create($incomingFields);

        return redirect('/admins');
        
    }

    public function teamleads() {
        $users = User::inOrganization()->where('usertype','teamlead')->get();

        return view('teamlead.index', ['users'=>$users]);
    }

    public function addTeamLead() {
        return view('teamlead.create');
    }
    public function showEditTeamlead($id){
        $user = User::inOrganization()->find($id);
        return view('teamlead.edit',compact('user'));
    }
    public function deleteTeamlead($id){
        $user = User::inOrganization()->where('usertype','teamlead')->find($id);
        $user->delete();
        return redirect('/teamleads');
    }

    public function saveTeamlead(Request $request){
        $organizationId=auth()->user()->organization_id;
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','min:10','string','max:255', new PhoneNumber],
            // 'usertype'=>'required|string|max:255',
            'email'=>'required|email|unique:users|max:255',
            //'password'=>'required|string|max:255|min:8|confirmed',
            'password' => ['required','string','max:255','min:8','confirmed',Password::min(8)->letters()->numbers()],
            // 'target_group_id'=>'required|numeric|digits_between:1,11'
        ]);
        //return $incomingFields;
        
        
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['usertype']='teamlead';
        $incomingFields['target_group_id']=0;
        $incomingFields['region_id']=0;
        $incomingFields['territory_id']=0;
        $incomingFields['email']=strip_tags($incomingFields['email']);
        $incomingFields['password']=strip_tags($incomingFields['password']);
        $incomingFields['organization_id']=$organizationId;
        

        //return $incomingFields['usertype'];

        if($request['image']){

            $imageName = time().'.jpg';

            // Save image to public/images directory
            //$request->image->move(public_path('images'), $imageName);
    
            //code from android version
            $folder="users";
            $imagePathOnDB=$folder."/".$imageName;
            //Storage::disk('public')->put($imagePath, $imageData);
            $incomingFields['image']=$imagePathOnDB;
    
            $image = $request->file('image');
            $imagePath = $image->getPathName();

            $compressedImagePath = storage_path('app/public/users/'.$imageName);

            $sourcePath = $imagePath;
            $maxSizeKB = 100;
            $destinationPath = $compressedImagePath;

            $this->compressImage($sourcePath,$destinationPath,$maxSizeKB);
            
        }else{
            $incomingFields['image']='';   
        }

        User::create($incomingFields);

        return redirect('/teamleads');
        
    }

    public function saveEditTeamlead($id, Request $request){
        $organizationId=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','min:10','string','max:255', new PhoneNumber],
            //'usertype'=>'required|string|max:255',
            // 'email'=>'required|email|max:255',
            // 'email'=>'required|email|unique:users|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            // 'target_group_id'=>'required|numeric|digits_between:1,11'
        ]);

        $incomingFields['name']=strip_tags($incomingFields['name']);
        //$incomingFields['usertype']='teamlead';
        $incomingFields['email']=strip_tags($incomingFields['email']);
        // $incomingFields['target_group_id']=strip_tags($incomingFields['target_group_id']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['organization_id']=$organizationId;

        $user=User::inOrganization()->find($id);

        if ($request->input('default_file_removed') == 1 && !$request->hasFile('image')) {

            //return "default image removed and none uploaded";
            // Default file has been removed, handle accordingly
            $path = "";
            $incomingFields['image']=$path;
            // Optionally delete the old file if needed
            if ($request->input('existing_file')) {
                Storage::disk('public')->delete($request->input('existing_file'));
            }

        } elseif ($request->hasFile('image')) {
            //return "image uploaded";
            // Store the new file
            // $file = $request->file('file');
            // $path = $file->store('uploads', 'public');

            $request->validate([
                'image' => 'image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048'
            ]);


            // $imageName = time().'.'.$request->image->extension();
            // $folder="users";
            // $imagePath=$folder."/".$imageName;
            // $incomingFields['image']=$imagePath;
            // $path = $request->file('image')->storeAs($folder, $imageName, 'public');

            

            $imageName = time().'.jpg';
            $folder="users";
            $imagePathOnDB=$folder."/".$imageName;
            $incomingFields['image']=$imagePathOnDB;

            $image = $request->file('image');
            $imagePath = $image->getPathName();

            $compressedImagePath = storage_path('app/public/users/'.$imageName);

            $sourcePath = $imagePath;
            $maxSizeKB = 100;
            $destinationPath = $compressedImagePath;

            $this->compressImage($sourcePath,$destinationPath,$maxSizeKB);



            // Optionally delete the old file if it exists
            if ($request->input('existing_file')) {
                Storage::disk('public')->delete($request->input('existing_file'));
            }

        } else {
            //return "image has not been changed";
            // Use the existing file path
            $path = $request->input('existing_file');
            // no need to access this
            // $incomingFields['image']=$path;
        }

        $user->update($incomingFields);

        return redirect('/teamleads');
        
    }


    public function saveSeller(Request $request){
        $organizationId=auth()->user()->organization_id;
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','min:10','string','max:255', new PhoneNumber],
            // 'usertype'=>'required|string|max:255',
            'email'=>'required|email|unique:users|max:255',
            //'password'=>'required|string|max:255|min:8|confirmed',
            'password' => ['required','string','max:255','min:8','confirmed',Password::min(8)->letters()->numbers()],
            'target_group_id'=>'required|numeric|digits_between:1,20',
            'region_id'=>'required|numeric|digits_between:1,20',
            'territory_id'=>'required|numeric|digits_between:1,20',
            'image' => 'image|mimes:jpeg,webp,png,jpg,gif,svg|max:3072'
        ]);
        //return $incomingFields;
        
        
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['usertype']='seller';
        $incomingFields['target_group_id']=strip_tags($incomingFields['target_group_id']);
        $incomingFields['region_id']=strip_tags($incomingFields['region_id']);
        $incomingFields['territory_id']=strip_tags($incomingFields['territory_id']);
        $incomingFields['email']=strip_tags($incomingFields['email']);
        $incomingFields['password']=strip_tags($incomingFields['password']);
        $incomingFields['organization_id']=$organizationId;

        //return $request->image;


        if($request['image']){
            
            $imageName = time().'.jpg';
            $folder="users";
            $imagePathOnDB=$folder."/".$imageName;
            $incomingFields['image']=$imagePathOnDB;
    
            $image = $request->file('image');
            $imagePath = $image->getPathName();

            $compressedImagePath = storage_path('app/public/users/'.$imageName);

            $sourcePath = $imagePath;
            $maxSizeKB = 100;
            $destinationPath = $compressedImagePath;

            $this->compressImage($sourcePath,$destinationPath,$maxSizeKB);

            
        }else{
            $incomingFields['image']='';   
        }
        

        //return $incomingFields['usertype'];

        User::create($incomingFields);

        return redirect('/sellers');
        
    }

    public function addSeller() {
        $targetgroups = TargetGroup::all();
        $regions = Region::all();
        $territories = Territory::all();
        return view('add-seller',compact('regions','territories','targetgroups'));
    }
    public function addAdmin() {
        return view('add-admin');
    }


    public function showEditSeller($id){
        $user = User::inOrganization()->find($id);
        $targetgroups = TargetGroup::all();
        $regions = Region::all();
        $territories = Territory::all();
        return view('edit-seller',compact('user','targetgroups','regions','territories'));
    }
    public function showEditAdmin($id){
        $user = User::inOrganization()->find($id);
        return view('edit-admin',compact('user'));
    }

    // public function showEditUser(Request $request){
    //     //$user = User::inOrganization()->find($id);
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $user = User::inOrganization()->find($incomingFields['id']);
    //     $targetgroups = TargetGroup::all();
    //     return view('edit-user',compact('user','targetgroups'));
    // }

    public function saveEditSeller($id, Request $request){
        $organizationId=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','min:10','string','max:255', new PhoneNumber],
            //'usertype'=>'required|string|max:255',
            // 'email'=>'required|email|max:255',
            // 'email'=>'required|email|unique:users|max:255',
            
            'image' => 'image|mimes:jpeg,webp,png,jpg,gif,svg|max:3072',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'target_group_id'=>'required|numeric|digits_between:1,20',
            'region_id'=>'required|numeric|digits_between:1,20',
            'territory_id'=>'required|numeric|digits_between:1,20',
        ]);

        $incomingFields['name']=strip_tags($incomingFields['name']);
        //$incomingFields['usertype']='seller';
        $incomingFields['email']=strip_tags($incomingFields['email']);
        $incomingFields['target_group_id']=strip_tags($incomingFields['target_group_id']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['organization_id']=$organizationId;
        $incomingFields['region_id']=strip_tags($incomingFields['region_id']);
        $incomingFields['territory_id']=strip_tags($incomingFields['territory_id']);

        // return $incomingFields;

        $user=User::inOrganization()->find($id);


        if ($request->input('default_file_removed') == 1 && !$request->hasFile('image')) {

            //return "default image removed and none uploaded";
            // Default file has been removed, handle accordingly
            $path = "";
            $incomingFields['image']=$path;
            // Optionally delete the old file if needed
            if ($request->input('existing_file')) {
                Storage::disk('public')->delete($request->input('existing_file'));
            }

        } elseif ($request->hasFile('image')) {
            //return "image uploaded";
            // Store the new file
            // $file = $request->file('file');
            // $path = $file->store('uploads', 'public');

            $request->validate([
                'image' => 'image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048'
            ]);
            // old code
            // $imageName = time().'.'.$request->image->extension();
            // $folder="users";
            // $imagePath=$folder."/".$imageName;
            // $incomingFields['image']=$imagePath;
            // $path = $request->file('image')->storeAs($folder, $imageName, 'public');
            // old code

            $imageName = time().'.jpg';
            $folder="users";
            $imagePathOnDB=$folder."/".$imageName;
            $incomingFields['image']=$imagePathOnDB;

            $image = $request->file('image');
            $imagePath = $image->getPathName();

            $compressedImagePath = storage_path('app/public/users/'.$imageName);

            $sourcePath = $imagePath;
            $maxSizeKB = 100;
            $destinationPath = $compressedImagePath;

            $this->compressImage($sourcePath,$destinationPath,$maxSizeKB);

            // Optionally delete the old file if it exists
            if ($request->input('existing_file')) {
                Storage::disk('public')->delete($request->input('existing_file'));
            }

        } else {
            //return "image has not been changed";
            // Use the existing file path
            $path = $request->input('existing_file');
            // no need to access this
            // $incomingFields['image']=$path;
        }

        $user->update($incomingFields);

        return redirect('/sellers');
        
    }

    public function saveEditAdmin($id, Request $request){
        $organizationId=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'phone'=>['required','min:10','string','max:255', new PhoneNumber],
            //'usertype'=>'required|string|max:255',
            // 'email'=>'required|email|max:255',
            // 'email'=>'required|email|unique:users|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            // 'target_group_id'=>'required|numeric|digits_between:1,11'
        ]);

        $incomingFields['name']=strip_tags($incomingFields['name']);
        //$incomingFields['usertype']='admin';
        $incomingFields['email']=strip_tags($incomingFields['email']);
        // $incomingFields['target_group_id']=strip_tags($incomingFields['target_group_id']);
        $incomingFields['phone']=strip_tags($incomingFields['phone']);
        $incomingFields['organization_id']=$organizationId;

        $user=User::inOrganization()->find($id);

        if ($request->input('default_file_removed') == 1 && !$request->hasFile('image')) {

            //return "default image removed and none uploaded";
            // Default file has been removed, handle accordingly
            $path = "";
            $incomingFields['image']=$path;
            // Optionally delete the old file if needed
            if ($request->input('existing_file')) {
                Storage::disk('public')->delete($request->input('existing_file'));
            }

        } elseif ($request->hasFile('image')) {
            //return "image uploaded";
            // Store the new file
            // $file = $request->file('file');
            // $path = $file->store('uploads', 'public');

            $request->validate([
                'image' => 'image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048'
            ]);


            // $imageName = time().'.'.$request->image->extension();
            // $folder="users";
            // $imagePath=$folder."/".$imageName;
            // $incomingFields['image']=$imagePath;
            // $path = $request->file('image')->storeAs($folder, $imageName, 'public');

            

            $imageName = time().'.jpg';
            $folder="users";
            $imagePathOnDB=$folder."/".$imageName;
            $incomingFields['image']=$imagePathOnDB;

            $image = $request->file('image');
            $imagePath = $image->getPathName();

            $compressedImagePath = storage_path('app/public/users/'.$imageName);

            $sourcePath = $imagePath;
            $maxSizeKB = 100;
            $destinationPath = $compressedImagePath;

            $this->compressImage($sourcePath,$destinationPath,$maxSizeKB);



            // Optionally delete the old file if it exists
            if ($request->input('existing_file')) {
                Storage::disk('public')->delete($request->input('existing_file'));
            }

        } else {
            //return "image has not been changed";
            // Use the existing file path
            $path = $request->input('existing_file');
            // no need to access this
            // $incomingFields['image']=$path;
        }

        $user->update($incomingFields);

        return redirect('/admins');
        
    }

    public function showChangePassword($usertype,$id){
        $user = User::inOrganization()->find($id);
        return view('changepassword',compact('usertype','user'));
    }

    // public function showChangePassword(Request $request){
    //     //$user = User::inOrganization()->find($id);
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $user = User::inOrganization()->find($incomingFields['id']);
    //     return view('changepassword',['user'=>$user]);
    // }
    

    public function saveChangePassword($id, Request $request){
        $incomingFields=$request->validate([
            'password'=>'required|confirmed|min:8',
            'usertype'=>'required|string|in:admin,seller,teamlead'
        ]);

        $incomingFields['password']=strip_tags($incomingFields['password']);
        $usertype=strip_tags($incomingFields['password']);

        $user=User::inOrganization()->find($id);

        $user->update($incomingFields);

        //return redirect('/edituser/'.$id);
        if($usertype=='admin'){
        return redirect('/admins');
        }
        else if($usertype=='teamleads'){
            return redirect('/teamleads');
            }
        {
            return redirect('/sellers');
        }
        
    }

    public function showProfile(){
        // if(Auth::check()) 
        // {
        // $user_id=Auth::user()->id;
        // }
        $user = User::inOrganization()->find(auth()->user()->id);
        return view('edit-profile',['user'=>$user]);
    }

    

}
