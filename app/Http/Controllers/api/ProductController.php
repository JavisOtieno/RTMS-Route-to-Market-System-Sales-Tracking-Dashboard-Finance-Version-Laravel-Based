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
            $products = Product::orderBy('id', 'DESC')
            ->withSum(['saleitems as total_sales' => function ($query) {
                $query->whereMonth('created_at', now()->month)  // Filter by current month
                      ->whereYear('created_at', now()->year)   // Filter by current year
                      ->select(DB::raw('SUM(value)'));         // Sum of 'value' column
            }], 'value')
            ->withSum(['saleitems as total_quantity' => function ($query) {
                $query->whereMonth('created_at', now()->month)  // Filter by current month
                      ->whereYear('created_at', now()->year)   // Filter by current year
                      ->select(DB::raw('SUM(quantity)'));       // Sum of 'quantity' column
            }], 'quantity')
            ->get();
            return response()->json(['products'=>$products]);
        }
        public function productsInStock(){
            // where('stock' > 0)
            $products = Product::orderBy('id', 'DESC')
            ->where('stock', '>', '0')
            ->orWhere('producttype', 'service')
            ->get();
            return response()->json(['products'=>$products]);
            
        }

}
