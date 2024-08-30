<?php

namespace App\Http\Controllers;

use Imagick;
use App\Models\Team;
use App\Models\Product;
use Illuminate\Http\Request;
use League\Glide\ServerFactory;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Spatie\ImageOptimizer\Optimizers\Svgo;
use Spatie\ImageOptimizer\Optimizers\Optipng;

use Intervention\Image\Facades\Image as Image;
use Spatie\ImageOptimizer\Optimizers\Gifsicle;
use Spatie\ImageOptimizer\Optimizers\Jpegoptim;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use League\Glide\Responses\LaravelResponseFactory;




class ProductController extends CommonController
{

    public function ajaxServicesYajraTest()
    {
        $services = Product::where('producttype','service')->get();
        return DataTables::of($services)->make(true);
    }
    public function viewServicesYajraTest()
    {
        return view('servicesyajratest');
    }
    
    //
    public function apiindex(){
        //$sales = Sale::all();
        $products = Product::all();

        return response()->json(['products'=>$products]);

    }
    public function index() {
        $products = Product::where('producttype', 'product')->orWhereNull('producttype')->get();

        //dd($sales);
        return view('product.index', ['products'=>$products]);
    }

    public function services() {
        $products = Product::where('producttype','service')->get();

        //dd($sales);
        return view('service.index', ['products'=>$products]);
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }
    public function deleteService($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('/services');
    }
    public function addProduct() {
        $teams = Team::all();
        return view('product.create',compact('teams'));
    }
    public function addService() {
        $teams = Team::all();
        return view('service.create', compact('teams'));
    }


    public function testCompress(){
    
        //using intervention 2.7.2
        // Get the uploaded image
        // $image = $request->file('image');
        // $imagePath = $image->getPathName();
        // 1722321638.png
        // 1722323337.jpg
        // $imagePath = public_path('images/1722321638.png');
        $imagePath = public_path('images/2mb.jpg');
        // $imagePath = public_path('images/1722323337.jpg');
        // $imagePath = public_path('images/testcompressjpgtest22.jpg');
        // $imagePath = public_path('images/2mbpng2.jpg');
        $imagePath = public_path("images/testcompressjpgtest4.jpg");
        $imagePath = public_path("images/4835.jpg"); //104kb
        $imagePath = public_path("images/5372DC.jpg"); //500kb
        $imagePath = public_path("images/Office-065.png"); //40mb
        
        

        $compressedImagePath = public_path('images/testcompressjpgtest444.jpg');
    
        // Create an image instance
        // $img = Image::make($imagePath);

        // Compress the image
        // $img->save($compressedImagePath, 80); // 80 is the quality percentage

        // Compress image to be under 200KB

            return $this->compressImageToSize($imagePath, $compressedImagePath, 100);
    



    }

    private function compressImageToSize($sourcePath, $destinationPath, $maxSizeKB)
    {
        function showbytes($filepath){
            $bytes= filesize($filepath);
        
            if ($bytes >= 1073741824) {
                $bytes = number_format($bytes / 1073741824, 2) . ' GB';
            } elseif ($bytes >= 1048576) {
                $bytes = number_format($bytes / 1048576, 2) . ' MB';
            } elseif ($bytes >= 1024) {
                $bytes = number_format($bytes / 1024, 2) . ' KB';
            } elseif ($bytes > 1) {
                $bytes = $bytes . ' bytes';
            } elseif ($bytes == 1) {
                $bytes = $bytes . ' byte';
            } else {
                $bytes = '0 bytes';
            }
            return $bytes;
        }
        $bytes_story='';

        if(filesize($sourcePath)>100*1024){

        $img = Image::make($sourcePath);
        
        $bytes_story=$bytes_story.'Initial file size'.showbytes($sourcePath).'<br/>';
        
        // Save the image to a temporary path
        // $tempPath = $destinationPath . '.jpg';
        $tempPath = $destinationPath;



        $width = $img->width();
        $height = $img->height();
        $maxWidth = 1920; // Example max width
        $maxHeight = 1080; // Example max height

        //  $bytes_story=$bytes_story."Before resize".showbytes($sourcePath)."<br/>";

        //Size is critical especially for large images, it reduces the size of the image significantly
        if ($width > $maxWidth || $height > $maxHeight) {
            $img->resize($maxWidth, $maxHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        $img->save($tempPath, 90);

        $bytes_story=$bytes_story."Initial step".showbytes($tempPath)."<br/>";

        $quality = 100; // Start with high quality

        while (filesize($tempPath) > $maxSizeKB * 1024 && $quality > 10) {
            // $quality -= 10; // Reduce quality by 10%
            // $img->save($tempPath, $quality);
            // $bytes_story=$bytes_story."While quality loop".$quality." ".showbytes($tempPath)."<br/>";
            // clearstatcache(true, $tempPath); // Clear cache for specific file
            
            $quality -= 10; // Reduce quality by 10%
            $img->save($tempPath, $quality);
            
            // Debugging information
            // clearstatcache(); // Clear cache to get the latest file size
            clearstatcache(true, $tempPath); // Clear cache for specific file
            
            $newFileSize = filesize($tempPath);
            $bytes_story .= "While quality loop. Quality: $quality, File Size: " . showbytes($tempPath) 
            . " ($newFileSize bytes)<br/>";
            
            if ($newFileSize >= filesize($tempPath)) {
                // If the file size doesn't change, break the loop to avoid infinite loop
                $bytes_story .= "File size did not change, breaking the loop.<br/>";
                //break;
            }

        }

        // if (filesize($tempPath) > $maxSizeKB * 1024) {

        //         // Fine-tune the quality in smaller steps if needed
        //         while (filesize($tempPath) > $maxSizeKB * 1024 && $quality > 0) {
        //             $quality -= 1; // Reduce quality by 1%
        //             $img->save($tempPath, $quality);
        //         }

        // }
        $bytes_story=$bytes_story."Before rename after while".$quality." ".showbytes($destinationPath)."<br/>";

        // Move the compressed image to the final destination
        rename($tempPath, $destinationPath);

        $bytes_story=$bytes_story."After rename after while".$quality." ".showbytes($destinationPath)."<br/>";


    }else{
        $bytes_story=$bytes_story."File does not need compression ".showbytes($sourcePath)."<br/>"; 
    }

    return $bytes_story;

    }

    public function saveService(Request $request){
        $team_id=$this->teamIdCheckAssign($request);

        // required not necessary
        //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        // return "we get here";
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'targettype'=>'required|string|max:255',
            'target'=>'required|numeric|digits_between:1,11',
            'description'=>'required|string',
            //max 2048 removed temporarily
            'image' => 'image|mimes:jpeg,webp,png,jpg,gif,svg'
        ]);
        
      

        
        $organization_id=auth()->user()->organization_id;
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['targettype']=strip_tags($incomingFields['targettype']);
        $incomingFields['producttype']='service';
        $incomingFields['target']=strip_tags($incomingFields['target']);
        $incomingFields['price']=0;
        $incomingFields['stock']=0;

        $incomingFields['sku']='';
    
        $incomingFields['description']=strip_tags($incomingFields['description']);
        $incomingFields['organization_id']=$organization_id;
        $incomingFields['team_id']=$team_id;
        //$incomingFields['image']=strip_tags($incomingFields['image']);


        if($request['image']){

            // $imageName = time().'.'.$request->image->extension();
            $imageName = time().'.jpg';

            // Save image to public/images directory
            //$request->image->move(public_path('images'), $imageName);
    
            //code from android version
            $folder="products";
            $imagePath=$folder."/".$imageName;
            //Storage::disk('public')->put($imagePath, $imageData);
            $incomingFields['image']=$imagePath;
    
            $image = $request->file('image');
            $imagePath = $image->getPathName();

            $compressedImagePath = storage_path('app/public/products/'.$imageName);

            $sourcePath = $imagePath;
            $maxSizeKB = 100;
            $destinationPath = $compressedImagePath;

            // return "Paths: ".$sourcePath." ".$maxSizeKB." ".$compressedImagePath;


            $this->compressImage($sourcePath,$destinationPath,$maxSizeKB);

            //store to products
            // $path = $request->file('image')->storeAs($folder, $imageName, 'public');
            
        }else{
            $incomingFields['image']='';   
        }
        //return $incomingFields;


        Product::create($incomingFields);

        return redirect('/services');
        
    }


    

    public function saveProduct(Request $request){
        // return $teamIdValid;
        $team_id=$this->teamIdCheckAssign($request);

        // required not necessary
        //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        // return "we get here";
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'price'=>'required|numeric|digits_between:1,11',
            'sku'=>'required|string|unique:products|max:255',
            'stock'=>'required|numeric|digits_between:1,11',
            'description'=>'required|string',
            //max 2048 removed temporarily
            'image' => 'image|mimes:jpeg,webp,png,jpg,gif,svg'
        ]);
        
      

        
        $organization_id=auth()->user()->organization_id;
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['price']=strip_tags($incomingFields['price']);
        $incomingFields['sku']=strip_tags($incomingFields['sku']);
        $incomingFields['stock']=strip_tags($incomingFields['stock']);
        $incomingFields['description']=strip_tags($incomingFields['description']);
        $incomingFields['team_id']=$team_id;
        $incomingFields['organization_id']=$organization_id;
        //$incomingFields['image']=strip_tags($incomingFields['image']);


        if($request['image']){

            // $imageName = time().'.'.$request->image->extension();
            $imageName = time().'.jpg';

            // Save image to public/images directory
            //$request->image->move(public_path('images'), $imageName);
    
            //code from android version
            $folder="products";
            $imagePath=$folder."/".$imageName;
            //Storage::disk('public')->put($imagePath, $imageData);
            $incomingFields['image']=$imagePath;
    
            $image = $request->file('image');
            $imagePath = $image->getPathName();

            $compressedImagePath = storage_path('app/public/products/'.$imageName);

            $sourcePath = $imagePath;
            $maxSizeKB = 100;
            $destinationPath = $compressedImagePath;

            // return "Paths: ".$sourcePath." ".$maxSizeKB." ".$compressedImagePath;


            $this->compressImage($sourcePath,$destinationPath,$maxSizeKB);

            //store to products
            // $path = $request->file('image')->storeAs($folder, $imageName, 'public');
            
        }else{
            $incomingFields['image']='';   
        }

        Product::create($incomingFields);

        return redirect('/products');
        
    }






    public function showEditProduct($id){
        $product = Product::find($id);
        $teams = Team::all();
        return view('product.edit',compact('product','teams'));
    }

    public function showEditService($id){
        $product = Product::find($id);
        $teams = Team::all();
        return view('service.edit',compact('product','teams'));
    }

    // public function showEditProduct(Request $request){
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $product = Product::find($incomingFields['id']);
    //     return view('edit-product',['product'=>$product]);
    // }

    public function saveEditProduct($id, Request $request){
        $team_id=$this->teamIdCheckAssign($request);
        //return $request;
        // $organization_id=auth()->user()->organization_id;
        // $team_id=auth()->user()->team_id;
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'price'=>'required|numeric|digits_between:1,11',
//            'sku'=>'required|string|unique:products|max:255',
            'sku' => 'required|string|max:255|unique:products,sku,' . $id,
            'stock'=>'required|numeric|digits_between:1,11',
            'description'=>'required|string',
            'image' => ''
        ]);

        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['price']=strip_tags($incomingFields['price']);
        $incomingFields['sku']=strip_tags($incomingFields['sku']);
        $incomingFields['stock']=strip_tags($incomingFields['stock']);
        $incomingFields['description']=strip_tags($incomingFields['description']);
        // $incomingFields['organization_id']=$organization_id;
        $incomingFields['team_id']=$team_id;

        $product=Product::find($id);

        // if($request['image']){
        //     return $request['image'];
        // }else{
        //     return "image not present";
        // }







        if ($request->input('default_file_removed') == 1 && !$request->hasFile('image')) {

            //return "default image removed and none uploaded";
            // Default file has been removed, handle accordingly
            $path = "";
            $incomingFields['image']=$path;
            // Optionally delete the old file if needed
            if ($request->input('existing_file')) {
                Storage::disk('public')->delete($request->input('existing_file'));
            }

            // return $request;
            // return "default file removed";

        } elseif ($request->hasFile('image')) {
            //return "image uploaded";
            // Store the new file
            // $file = $request->file('file');
            // $path = $file->store('uploads', 'public');

            $request->validate([
                // |max2048 removed for now
                'image' => 'image|mimes:jpeg,webp,png,jpg,gif,svg'
            ]);


            // OLD UPLOAD CODE WITHOUT COMPRESSION
            // $imageName = time().'.'.$request->image->extension();
            // $folder="products";
            // $imagePath=$folder."/".$imageName;
            // $incomingFields['image']=$imagePath;
            // $path = $request->file('image')->storeAs($folder, $imageName, 'public');
            // OLD UPLOAD CODE WITHOUT COMPRESSION

            $imageName = time().'.jpg';
            $folder="products";
            $imagePathOnDB=$folder."/".$imageName;
            $incomingFields['image']=$imagePathOnDB;

            $image = $request->file('image');
            $imagePath = $image->getPathName();

            $compressedImagePath = storage_path('app/public/products/'.$imageName);

            $sourcePath = $imagePath;
            $maxSizeKB = 100;
            $destinationPath = $compressedImagePath;

            //return "Paths: ".$sourcePath." ".$maxSizeKB." ".$compressedImagePath." ";
            $this->compressImage($sourcePath,$destinationPath,$maxSizeKB);

            // Optionally delete the old file if it exists
            if ($request->input('existing_file')) {
                Storage::disk('public')->delete($request->input('existing_file'));
            }

        } else {
            //return "image has not been changed";
            // Use the existing file path
            $path = $request->input('existing_file');
            // return $request;
            // no need to access this
            // $incomingFields['image']=$path;
        }

        
        // if($request['image']){

        //     Storage::disk('public')->delete($product['image']);

        //     $imageName = time().'.'.$request->image->extension();
            

        //     // Save image to public/images directory
        //     //$request->image->move(public_path('images'), $imageName);
    
        //     //code from android version
        //     $folder="products";
        //     $imagePath=$folder."/".$imageName;
        //     //Storage::disk('public')->put($imagePath, $imageData);
        //     $incomingFields['image']=$imagePath;
    
        //     //store using the storage facade
        //     //stores to images/folder in this case images/products/
        //     //$path = $request->file('image')->storeAs('images', $imagePath, 'public');
        //     //$path = $request->file('image')->storeAs('images', $imagePath, 'public');
    
        //     //store to products
        //     $path = $request->file('image')->storeAs($folder, $imageName, 'public');
            
        // }else{
        //     //$incomingFields['image']='';   
            
        // }

        $product->update($incomingFields);

        return redirect('/products');
        
    }


    public function saveEditService($id, Request $request){
        $team_id=$this->teamIdCheckAssign($request);
        //return $request;
        // $organization_id=auth()->user()->organization_id;
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'target'=>'required|numeric|digits_between:1,11',
//            'sku'=>'required|string|unique:products|max:255',
            'description'=>'required|string',
            'targettype'=>'required|string|max:255',
            'image' => ''
        ]);

        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['target']=strip_tags($incomingFields['target']);
        $incomingFields['description']=strip_tags($incomingFields['description']);
        $incomingFields['targettype']=strip_tags($incomingFields['targettype']);
        $incomingFields['team_id']=$team_id;
        // $incomingFields['organization_id']=$organization_id;

        $product=Product::find($id);

        // if($request['image']){
        //     return $request['image'];
        // }else{
        //     return "image not present";
        // }







        if ($request->input('default_file_removed') == 1 && !$request->hasFile('image')) {

            //return "default image removed and none uploaded";
            // Default file has been removed, handle accordingly
            $path = "";
            $incomingFields['image']=$path;
            // Optionally delete the old file if needed
            if ($request->input('existing_file')) {
                Storage::disk('public')->delete($request->input('existing_file'));
            }

            // return $request;
            // return "default file removed";

        } elseif ($request->hasFile('image')) {
            //return "image uploaded";
            // Store the new file
            // $file = $request->file('file');
            // $path = $file->store('uploads', 'public');

            $request->validate([
                // |max2048 removed for now
                'image' => 'image|mimes:jpeg,webp,png,jpg,gif,svg'
            ]);


            // OLD UPLOAD CODE WITHOUT COMPRESSION
            // $imageName = time().'.'.$request->image->extension();
            // $folder="products";
            // $imagePath=$folder."/".$imageName;
            // $incomingFields['image']=$imagePath;
            // $path = $request->file('image')->storeAs($folder, $imageName, 'public');
            // OLD UPLOAD CODE WITHOUT COMPRESSION

            $imageName = time().'.jpg';
            $folder="products";
            $imagePathOnDB=$folder."/".$imageName;
            $incomingFields['image']=$imagePathOnDB;

            $image = $request->file('image');
            $imagePath = $image->getPathName();

            $compressedImagePath = storage_path('app/public/products/'.$imageName);

            $sourcePath = $imagePath;
            $maxSizeKB = 100;
            $destinationPath = $compressedImagePath;

            //return "Paths: ".$sourcePath." ".$maxSizeKB." ".$compressedImagePath." ";
            $this->compressImage($sourcePath,$destinationPath,$maxSizeKB);

            // Optionally delete the old file if it exists
            if ($request->input('existing_file')) {
                Storage::disk('public')->delete($request->input('existing_file'));
            }

        } else {
            //return "image has not been changed";
            // Use the existing file path
            $path = $request->input('existing_file');
            // return $request;
            // no need to access this
            // $incomingFields['image']=$path;
        }

        
        // if($request['image']){

        //     Storage::disk('public')->delete($product['image']);

        //     $imageName = time().'.'.$request->image->extension();
            

        //     // Save image to public/images directory
        //     //$request->image->move(public_path('images'), $imageName);
    
        //     //code from android version
        //     $folder="products";
        //     $imagePath=$folder."/".$imageName;
        //     //Storage::disk('public')->put($imagePath, $imageData);
        //     $incomingFields['image']=$imagePath;
    
        //     //store using the storage facade
        //     //stores to images/folder in this case images/products/
        //     //$path = $request->file('image')->storeAs('images', $imagePath, 'public');
        //     //$path = $request->file('image')->storeAs('images', $imagePath, 'public');
    
        //     //store to products
        //     $path = $request->file('image')->storeAs($folder, $imageName, 'public');
            
        // }else{
        //     //$incomingFields['image']='';   
            
        // }

        $product->update($incomingFields);

        return redirect('/services');
        
    }
}
