<?php

namespace App\Http\Controllers\api;

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    //
    public function index(){
        //$sales = Sale::all();
        $userId = auth()->id();
        $sales = Sale::where('user_id',$userId)->with('user','visit','outlet','saleitems.product')->orderBy('id', 'DESC')->get();
        return response()->json(['sales'=>$sales]);
    }
    public function visitSales(Request $request){
        //$sales = Sale::all();
        $incomingFields=$request->validate([
            'visitId'=>'required',
        ]);
        $visitId=strip_tags($request['visitId']);

        $userId = auth()->id();
        $sales = Sale::where('visit_id', $visitId)->where('user_id',$userId)->with('user','visit','outlet','saleitems.product')->get();
        return response()->json(['sales'=>$sales]);
    }
    public function makesale(Request $request){

       
        $incomingFields=$request->validate([
            'pieces'=>'required',
        ]);

        $incomingFields=[];
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['outlet_id']=strip_tags($request['outletId']);
        $incomingFields['product_id']=strip_tags($request['productId']);
        $incomingFields['visit_id']=strip_tags($request['visitId']);
        $incomingFields['user_id']=strip_tags($request['userId']);
        $incomingFields['pieces']=strip_tags($request['pieces']);
        $incomingFields['organization_id']=auth()->user()->organization_id;

        $price = Product::find($incomingFields['product_id'])['price'];
        $incomingFields['value'] = $price * $incomingFields['pieces'];

        Sale::create($incomingFields);
        
        $saleStatus=array(
                "message" => "Sale Successful",
                "status" => "success");
        
        return response()->json($saleStatus);

}

//SAVE SALE PREVIOUS CODE

    public function saveSale(Request $request){

       
        // $incomingFields=
        $request->validate([
        //     'userId'=>'required',
        //     'time'=>'required',
        //     'lat'=>'required',
        //     'long'=>'required'
            'userId'=>'required|numeric|digits_between:1,20|exists:users,id',
            'outletId'=>'required|numeric|digits_between:1,11||exists:outlets,id',
            'visitId'=>'required|numeric|digits_between:1,11||exists:visits,id',
            'products'=>'required'
        ]);

        //Test Git


        $incomingFields=[];
        $incomingFields['products']=strip_tags($request['products']);
        $incomingFieldsSale['user_id']=strip_tags($request['userId']);
        $incomingFieldsSale['outlet_id']=strip_tags($request['outletId']);
        $incomingFieldsSale['visit_id']=strip_tags($request['visitId']);
        $incomingFieldsSale['organization_id']=auth()->user()->organization_id;
        
        $piecesTotal=0;
        $valueTotal=0;
        $incomingFieldsSale['pieces']=$piecesTotal;
        $incomingFieldsSale['value']=$valueTotal;

        if(strlen($incomingFields['products'])>0){

        $sale=Sale::create($incomingFieldsSale);
        $saleId=$sale->id;

        $incomingFieldsSaleItem['sale_id']=$saleId;

        
        //return $incomingFields['products'];
        $saleArray= explode('_',$incomingFields['products']);
        //return json_encode($posAuditArray);

        foreach ($saleArray as $productPiecesString) {
            # code...
            $productPiecesSplit=explode('-',$productPiecesString);
            //return $productPiecesSplit;
            $productId=$productPiecesSplit[0];
            $pieces=$productPiecesSplit[1];
            $piecesTotal=$piecesTotal+$pieces;

            $product=Product::find($productId);
            $productPrice=$product['price'];
            $incomingFieldsStock['stock']=$product['stock']-$pieces;
            $product->update($incomingFieldsStock);

            $value=$pieces*$productPrice;
            $valueTotal=$valueTotal+$value;
            $incomingFieldsSaleItem['product_id']=$productId;
            $incomingFieldsSaleItem['pieces']=$pieces;
            $incomingFieldsSaleItem['price']=$productPrice;
            $incomingFieldsSaleItem['value']=$pieces*$productPrice;
            SaleItem::create($incomingFieldsSaleItem);

        }

        //Posaudit::create($incomingFields);
        $incomingFieldsSaleUpdate['pieces']=$piecesTotal;
        $incomingFieldsSaleUpdate['value']=$valueTotal;
        $sale->update($incomingFieldsSaleUpdate);
        

        $saleStatus=array(
            "message" => "Sale Added Successful",
            "status" => "success");

        }else{
            $saletatus=array(
                "message" => "Product Numbers Missing",
                "status" => "failed");
        }

        return response()->json($saleStatus);
        
    }

    //SAVE SALE PREVIOUS CODE

}
