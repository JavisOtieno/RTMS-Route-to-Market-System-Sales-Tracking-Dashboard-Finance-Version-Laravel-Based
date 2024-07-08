<?php

namespace App\Http\Controllers\api;

use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posaudit;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
            
    public function upload(Request $request)
    {
            // Validate the request
            $request->validate([
                'base64' => 'required|string',
                'ImageName' => 'required|string|max:255',
                'outletPOSAuditId' => 'required|numeric|digits_between:1,20',
                'folder' => 'required|string|max:255'
            ]);
            $imageName=$request->input('ImageName');
            $folder=$request->input('folder');
            if($folder=="posaudits"){
                $request->validate([
                    'outletPOSAuditId' => 'exists:posaudits,id',
                ]);
            }else{
                $request->validate([
                    'outletPOSAuditId' => 'exists:outlets,id',
                ]);
            }
    
            // Decode the base64 image string
            $base64Image = $request->input('base64');
            $imageData = base64_decode($base64Image);

            //get the outlet id
            $outletPOSAuditId = $request->input('outletPOSAuditId');
    
            // Store the image file
            //$imageName = time() . '.jpg'; // You can generate a unique name here
            
            $imagePath=$folder."/".$imageName;
            Storage::disk('public')->put($imagePath, $imageData);
    
            // Optionally, you can also store the image path in a database
            if($folder=="posaudits")
            {
                //get the posaudit id
                $posaudit=Posaudit::find($outletPOSAuditId);
                $incomingFields['image']=strip_tags($imagePath);
                $posaudit->update($incomingFields);
            }
            else
            {
                $outlet=Outlet::find($outletPOSAuditId);
                $incomingFields['image']=strip_tags($imagePath);
                $outlet->update($incomingFields);
            }
    
            return response()->json(['message' => 'Image uploaded successfully', 'name' => $imageName]);
       
     
}




}
