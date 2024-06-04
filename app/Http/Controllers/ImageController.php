<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function showImage($folder,$image){
        return view('showimage',compact('folder','image'));
    }
}
