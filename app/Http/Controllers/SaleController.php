<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    //

    public function index() {
        $sales = Sale::with('user','visit','outlet','saleitems.product')->orderBy('id', 'DESC')->get();
        //dd($sales);
        return view('sales', ['sales'=>$sales]);
    }

    public function addSale() {
        $users = User::inOrganization()->get();
        $outlets = Outlet::all();
        $products = Product::all();
        //dd($sales);
        return view('add-sale', compact('users','outlets','products'));
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
        $incomingFields['visit_id']='0';
        $incomingFields['pieces']=strip_tags($request['pieces']);
        $incomingFields['organization_id']=auth()->user()->organization_id;

        $price = Product::find($incomingFields['product_id'])['price'];
        $incomingFields['value'] = $price * $incomingFields['pieces'];

        //return $incomingFields;

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
        $organization_id=auth()->user()->organization_id;
        
        $incomingFields=$request->validate([
            'userId'=>'required',
            'outletId'=>'required',
            'productId'=>'required',
            'pieces'=>'required'
        ]);

        $incomingFields['organization_id']=$organization_id;
        $incomingFields['user_id']=strip_tags($incomingFields['userId']);
        $incomingFields['outlet_id']=strip_tags($incomingFields['outletId']);
        $incomingFields['product_id']=strip_tags($incomingFields['productId']);
        $incomingFields['pieces']=strip_tags($incomingFields['pieces']);

        $sale=Sale::find($id);

        $sale->update($incomingFields);

        return redirect('/sales');
        
    }
    

}
