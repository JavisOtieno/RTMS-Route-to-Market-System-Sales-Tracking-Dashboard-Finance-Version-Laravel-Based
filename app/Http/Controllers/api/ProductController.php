<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
            ->where('stock', '>', '0')
            ->orWhere('producttype', 'service')
            ->withSum(['saleitems as total_sales' => function ($query) {
                $query->select(DB::raw('SUM(value)'));  // Replace 'value' with the actual column you want to sum
            }], 'value') 
            ->get();
            return response()->json(['products'=>$products]);
            
        }

}
