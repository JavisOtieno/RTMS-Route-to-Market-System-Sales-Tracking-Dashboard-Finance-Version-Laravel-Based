<?php

namespace App\Http\Controllers\api;

use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
            
    public function upload(Request $request)
    {
            // Validate the request
            $request->validate([
                'base64' => 'required|string',
                'ImageName' => 'required',
                'outletId' => 'required'
            ]);
    
            // Decode the base64 image string
            $base64Image = $request->input('base64');
            $imageData = base64_decode($base64Image);

            //get the outlet id
            $outletId = $request->input('outletId');
    
            // Store the image file
            //$imageName = time() . '.jpg'; // You can generate a unique name here
            $imageName=$request->input('ImageName');
            $imagePath="outlets/".$imageName;
            Storage::disk('public')->put($imagePath, $imageData);
    
            // Optionally, you can also store the image path in a database
           
            $outlet=Outlet::find($outletId);
            $incomingFields['image']=strip_tags($imagePath);
            $outlet->update($incomingFields);
    
            return response()->json(['message' => 'Image uploaded successfully', 'name' => $imageName]);
       
     
}
}
