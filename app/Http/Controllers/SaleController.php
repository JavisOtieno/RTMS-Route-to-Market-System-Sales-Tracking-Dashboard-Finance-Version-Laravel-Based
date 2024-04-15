<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    //

    public function index() {
        $sales = Sale::with('user','outlet','product')->orderBy('id', 'DESC')->get();
        //dd($sales);
        return view('sales', ['sales'=>$sales]);
    }
    public function addSale() {
        return view('add-sale');
    }
    public function saveSale(Request $request){
       
        /*
        $incomingFields=$request->validate([
            'userId'=>'required',
            'outletId'=>'required',
            'productId'=>'required',
            'pieces'=>'required'
        ]);

        $incomingFields['user_id']=strip_tags($incomingFields['userId']);
        $incomingFields['outlet_id']=strip_tags($incomingFields['outletId']);
        $incomingFields['product_id']=strip_tags($incomingFields['productId']);
        $incomingFields['pieces']=strip_tags($incomingFields['pieces']);
        */

        $validator = Validator::make($request->all(), [
            'userId'=>'required',
            'outletId'=>'required',
            'productId'=>'required',
            'pieces'=>'required'
        ]);
        
        if ($validator->fails()) {
            //return view('view_name');
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        } 
        // else {
        //     return view('view_name');
        // }
        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['outlet_id']=strip_tags($request['outletId']);
        $incomingFields['product_id']=strip_tags($request['productId']);
        $incomingFields['pieces']=strip_tags($request['pieces']);

        Sale::create($incomingFields);

        return redirect('/sales');
        
    }

    public function deleteSale($id){
        $sale = Sale::find($id);
        $sale->delete();
        return redirect('/sales');
    }

    public function showEditSale($id){
        $sale = Sale::find($id);
        return view('edit-sale',['sale'=>$sale]);
    }

    public function saveEditSale($id, Request $request){
        $incomingFields=$request->validate([
            'userId'=>'required',
            'outletId'=>'required',
            'productId'=>'required',
            'pieces'=>'required'
        ]);

        $incomingFields['user_id']=strip_tags($incomingFields['userId']);
        $incomingFields['outlet_id']=strip_tags($incomingFields['outletId']);
        $incomingFields['product_id']=strip_tags($incomingFields['productId']);
        $incomingFields['pieces']=strip_tags($incomingFields['pieces']);

        $sale=Sale::find($id);

        $sale->update($incomingFields);

        return redirect('/sales');
        
    }
    

}
