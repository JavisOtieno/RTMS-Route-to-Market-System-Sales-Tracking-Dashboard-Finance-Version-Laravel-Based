<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
       
        $incomingFields=$request->validate([
            'name'=>'required',
            'sku'=>'required',
            'price'=>'required',
            'description'=>'required'
        ]);
        
        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['price']=strip_tags($incomingFields['price']);
        $incomingFields['sku']=strip_tags($incomingFields['sku']);
        $incomingFields['description']=strip_tags($incomingFields['description']);

        Product::create($incomingFields);

        return redirect('/products');
        
    }

    public function showEditProduct($id){
        $product = Product::find($id);
        return view('edit-product',['product'=>$product]);
    }
    public function saveEditProduct($id, Request $request){
        $incomingFields=$request->validate([
            'name'=>'required',
            'price'=>'required',
            'sku'=>'required',
            'description'=>'required'
        ]);

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['price']=strip_tags($incomingFields['price']);
        $incomingFields['sku']=strip_tags($incomingFields['sku']);
        $incomingFields['description']=strip_tags($incomingFields['description']);

        $product=Product::find($id);

        $product->update($incomingFields);

        return redirect('/products');
        
    }
}
