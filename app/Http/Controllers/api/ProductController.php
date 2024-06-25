<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
        //
        public function index(){
            $products = Product::orderBy('id', 'DESC')->get();
            return response()->json(['products'=>$products]);
        }
        public function productsInStock(){
            // where('stock' > 0)
            $products = Product::orderBy('id', 'DESC')
            ->where('stock', '>', '0')->get();
            return response()->json(['products'=>$products]);
            
        }

}
