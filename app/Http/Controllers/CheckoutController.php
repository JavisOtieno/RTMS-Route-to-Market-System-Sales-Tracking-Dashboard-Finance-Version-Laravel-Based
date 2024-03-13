<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function apiindex(){
        $checkouts = Checkout::all();
        return response()->json(['checkouts'=>$checkouts]);
    }
    public function index() {
        $checkouts = Checkout::all();
        return view('checkouts', ['checkouts'=>$checkouts]);
    }
}
