<?php

namespace App\Http\Controllers\api;

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    //
    public function index(){
        //$sales = Sale::all();
        $userId = auth()->id();
        $sales = Sale::where('user_id',$userId)->with('user','visit','outlet','saleitems.product')->orderBy('id', 'DESC')->get();
        // return "nothing";
        return response()->json(['sales'=>$sales]);
       
    }
    public function visitSales(Request $request){
        //$sales = Sale::all();
        $incomingFields=$request->validate([
            'visitId'=>'required',
        ]);
        $visitId=strip_tags($request['visitId']);

        $userId = auth()->id();
        $sales = Sale::where('visit_id', $visitId)->where('user_id',$userId)->with('user','visit','outlet','saleitems.product')->orderBy('id', 'DESC')->get();
        return response()->json(['sales'=>$sales]);
    }
//     public function makesale(Request $request){

       
//         $incomingFields=$request->validate([
//             'pieces'=>'required',
//         ]);

//         $incomingFields=[];
//         $incomingFields['user_id']=strip_tags($request['userId']);
//         $incomingFields['outlet_id']=strip_tags($request['outletId']);
//         $incomingFields['product_id']=strip_tags($request['productId']);
//         $incomingFields['visit_id']=strip_tags($request['visitId']);
//         $incomingFields['user_id']=strip_tags($request['userId']);
//         $incomingFields['pieces']=strip_tags($request['pieces']);
//         $incomingFields['organization_id']=auth()->user()->organization_id;

//         $price = Product::find($incomingFields['product_id'])['price'];
//         $incomingFields['value'] = $price * $incomingFields['pieces'];

//         $sale=Sale::create($incomingFields);
//         $saleId = $sale->id;
        
//         $saleStatus=array(
//                 "message" => "Sale Successful",
//                 "saleId" => $saleId,
//                 "status" => "success"
//             );
        
//         return response()->json($saleStatus);

// }

//SAVE SALE PREVIOUS CODE

    public function pendingSale($id){

        $sale=Sale::find($id);
        $sale->update(['status' => 'pending']);

        $saleStatus=array(
            "message" => "Sale Updated Successfully",
            "saleId" => $id,
            "status" => "success");

        return response()->json($saleStatus);

    }

    public function completeSale($id){

        $sale=Sale::find($id);
        $sale->update(['status' => 'complete']);

        $saleStatus=array(
            "message" => "Sale Updated Successfully",
            "saleId" => $id,
            "status" => "success");

        return response()->json($saleStatus);

    }

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
        $incomingFieldsSale['user_id']=auth()->id();
        $incomingFieldsSale['outlet_id']=strip_tags($request['outletId']);
        $incomingFieldsSale['visit_id']=strip_tags($request['visitId']);
        $incomingFieldsSale['status']='complete';
        $incomingFieldsSale['organization_id']=auth()->user()->organization_id;
        $incomingFieldsSale['team_id']=auth()->user()->team_id;
        
        
        // return $incomingFieldsSale;

        $piecesTotal=0;
        $valueTotal=0;
        $incomingFieldsSale['pieces']=$piecesTotal;
        $incomingFieldsSale['value']=$valueTotal;
        $tracethrough = "start outside if";


            
        if(strlen($incomingFields['products'])>0){

        $saleStatus=DB::transaction(function () use($incomingFields,
        $incomingFieldsSale,$valueTotal,$piecesTotal,$tracethrough) {

        $sale=Sale::create($incomingFieldsSale);
        $saleId=$sale->id;

        $incomingFieldsSaleItem['sale_id']=$saleId;

        $tracethrough .= "start inside if";

        
        //return $incomingFields['products'];
        $saleArray= explode('_',$incomingFields['products']);
        //return json_encode($posAuditArray);
        $count = 0;

        foreach ($saleArray as $productPiecesString) {
            $count ++;
            # code...
            $productPiecesSplit=explode('-',$productPiecesString);
            //return $productPiecesSplit;
            $productId=$productPiecesSplit[0];
            $pieces=$productPiecesSplit[1];


            $incomingFieldsSaleItem['product_id']=$productId;
            

            $product=Product::find($productId);
            if($product->producttype=='service'){

                if($product->targettype=='quantity'){
                    //value is zero as it depends purely on quantity
                    $incomingFieldsSaleItem['pieces']=$pieces;
                    $incomingFieldsSaleItem['price']=0;
                    $incomingFieldsSaleItem['value']=0;
                    $piecesTotal=$piecesTotal+$pieces;
                    $tracethrough .=" - quantity";
                }else{
                    $value=1*$pieces;
                    $valueTotal=$valueTotal+$value;
                    $piecesTotal=$piecesTotal+1;
                    $incomingFieldsSaleItem['pieces']=1;
                    $incomingFieldsSaleItem['price']=$pieces;
                    $incomingFieldsSaleItem['value']=$pieces;
                    $tracethrough .=" - amount";
                }
                

            }else{
            $tracethrough .=" - product";
            $productPrice=$product['price'];
            $incomingFieldsStock['stock']=$product['stock']-$pieces;
            $product->update($incomingFieldsStock);
            
            $piecesTotal=$piecesTotal+$pieces;
            $value=$pieces*$productPrice;
            $valueTotal=$valueTotal+$value;
            $incomingFieldsSaleItem['pieces']=$pieces;
            $incomingFieldsSaleItem['price']=$productPrice;
            $incomingFieldsSaleItem['value']=$pieces*$productPrice;

            }

            SaleItem::create($incomingFieldsSaleItem);

        }

        //Posaudit::create($incomingFields);
        $tracethrough.="exit - pieces".$piecesTotal."value".$valueTotal;
        $incomingFieldsSaleUpdate['pieces']=$piecesTotal;
        $incomingFieldsSaleUpdate['value']=$valueTotal;
        $sale->update($incomingFieldsSaleUpdate);
        $saleId = $sale->id;
        

        $saleStatus=array(
            "message" => "Sale Added Successful",
            "saleId" => $saleId,
            "tracethrough" => $tracethrough,
            "status" => "success");
        
        return $saleStatus;

        });

        }else{
            $saletatus=array(
                "message" => "Product Numbers Missing",
                "status" => "failed");
        }

        return response()->json($saleStatus);
        
    }

    //SAVE SALE PREVIOUS CODE

}
