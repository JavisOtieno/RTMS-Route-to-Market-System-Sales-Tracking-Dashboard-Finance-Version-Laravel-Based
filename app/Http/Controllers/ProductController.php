<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function apiindex(){
        //$sales = Sale::all();
        $products = Product::all();
        return response()->json(['products'=>$products]);
    }
    public function index() {
        $products = Product::all();
        //dd($sales);
        return view('products', ['products'=>$products]);
    }
    public function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }
    public function addProduct() {
        return view('add-product');
    }
    public function saveProduct(Request $request){

        // required not necessary
        //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
       
        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'price'=>'required|numeric|digits_between:1,11',
            'sku'=>'required|string|unique:products|max:255',
            'stock'=>'required|numeric|digits_between:1,11',
            'description'=>'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        
        
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['price']=strip_tags($incomingFields['price']);
        $incomingFields['sku']=strip_tags($incomingFields['sku']);
        $incomingFields['stock']=strip_tags($incomingFields['stock']);
        $incomingFields['description']=strip_tags($incomingFields['description']);
        //$incomingFields['image']=strip_tags($incomingFields['image']);


        if($request['image']){

            $imageName = time().'.'.$request->image->extension();

            // Save image to public/images directory
            //$request->image->move(public_path('images'), $imageName);
    
            //code from android version
            $folder="products";
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



        Product::create($incomingFields);

        return redirect('/products');
        
    }

    public function showEditProduct($id){
        $product = Product::find($id);
        return view('edit-product',['product'=>$product]);
    }
    public function saveEditProduct($id, Request $request){
        //return $request;
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

        } elseif ($request->hasFile('image')) {
            //return "image uploaded";
            // Store the new file
            // $file = $request->file('file');
            // $path = $file->store('uploads', 'public');

            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);


            $imageName = time().'.'.$request->image->extension();
            
            $folder="products";
            $imagePath=$folder."/".$imageName;

            $incomingFields['image']=$imagePath;

            $path = $request->file('image')->storeAs($folder, $imageName, 'public');

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
}
