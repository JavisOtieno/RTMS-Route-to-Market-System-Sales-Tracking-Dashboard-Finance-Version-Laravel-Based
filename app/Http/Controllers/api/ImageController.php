<?php

namespace App\Http\Controllers\api;

use App\Models\Outlet;
use App\Models\Posaudit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CommonController;

class ImageController extends CommonController
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

        //           // Validate the image format
        // if (strpos($imageData, 'image/') === false) {
        //     // return response()->json(['error' => 'Invalid image format.'], 400);
        // return response()->json(['errors' => 'Invalid image format.',
        // 'message' => 'Invalid image format.'],400);
        // }

        // Validate the image size
        // $maxFileSize = 2 * 1024 * 1024; // 2 MB limit
        // if (strlen($imageData) > $maxFileSize) {
        //     return response()->json(['error' => 'Image exceeds the maximum size of 2 MB.'], 400);
        // }
            if (!@imagecreatefromstring($imageData)) {
                return response()->json(['errors' => 'Invalid image.',
            'message' => 'Invalid image.'], 422);
            }

            // Get the image MIME type
            $imageInfo = getimagesizefromstring($imageData);
            if (!$imageInfo) {
                return response()->json(['errors' => 'Invalid image data.',
            'message' => 'Invalid image data.'],400);
            }
            $imageMimeType = $imageInfo['mime'];
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (!in_array($imageMimeType, $allowedMimeTypes)) {
                return response()->json(['errors' => 'Unsupported image format.',
                'message' => 'Unsupported image format.',
            ], 400);
            }

                // Check if the string contains the base64 header
            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                $type = strtolower($type[1]); // jpeg, png, gif, etc.
                        // Check if the extension is allowed
            if (!in_array($type, ['jpeg', 'jpg', 'png', 'gif'])) {
                return response()->json(['error' => 'Invalid image type.'], 400);
            }
            
            }else{
                return response()->json(['error' => 'Invalid image type.'], 400);
            }

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

public function uploadImageEnctype(Request $request){

    $request->validate([
        // 'base64' => 'required|string',
        'image' => 'image|mimes:jpeg,webp,png,jpg,gif,svg|max:3072',
        'ImageName' => 'required|string|max:255',
        'outletPOSAuditId' => 'required|numeric|digits_between:1,20',
        'folder' => 'required|string|max:255'
    ]);

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
    $outletPOSAuditId = $request->input('outletPOSAuditId');

    

    if($request['image']){
        
            
        $imageName = $request['ImageName'].'.jpg';
        // $folder="users";
        // $imagefolder = strtolower($folder)."s/";
        $imagePathOnDB=$folder.'/'.$imageName;
        $incomingFields['image']=$imagePathOnDB;

        $image = $request->file('image');
        $imagePath = $image->getPathName();

        $compressedImagePath = storage_path('app/public/'.$folder.'/'.$imageName);

        $sourcePath = $imagePath;
        $maxSizeKB = 100;
        $destinationPath = $compressedImagePath;

        $this->compressImage($sourcePath,$destinationPath,$maxSizeKB);

        
    }else{
        $incomingFields['image']='';   
    }

    if($folder=="posaudits")
    {
        //get the posaudit id
        $posaudit=Posaudit::find($outletPOSAuditId);
        // $incomingFields['image']=strip_tags($imagePath);
        $posaudit->update($incomingFields);
    }
    else
    {
        $outlet=Outlet::find($outletPOSAuditId);
        // $incomingFields['image']=strip_tags($imagePath);
        $outlet->update($incomingFields);
    }

    return response()->json(['message' => 'Image uploaded successfully', 'name' => $imageName]);


}






}
