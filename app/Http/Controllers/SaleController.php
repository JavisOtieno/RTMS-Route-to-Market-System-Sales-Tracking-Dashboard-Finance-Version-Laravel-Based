<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    //
    public function apiindex(){
        //$sales = Sale::all();
        $sales = Sale::with('user','outlet')->get();
        return response()->json(['sales'=>$sales]);
    }
    public function index() {
        $sales = Sale::with('user','outlet')->orderBy('id', 'DESC')->get();
        //dd($sales);
        return view('sales', ['sales'=>$sales]);
    }
    public function addSale() {
        return view('add-sale');
    }
    public function saveSale(Request $request){
       
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
