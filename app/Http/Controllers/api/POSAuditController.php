<?php

namespace App\Http\Controllers\api;

use App\Models\Posaudit;
use App\Models\PosauditItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class POSAuditController extends Controller
{
    //

    public function savePOSAudit(Request $request){

       
        // $incomingFields=$request->validate([
        //     'userId'=>'required',
        //     'time'=>'required',
        //     'lat'=>'required',
        //     'long'=>'required'
        // ]);

        //Test Git


        $incomingFields=[];
        $incomingFields['products']=strip_tags($request['products']);
        $incomingFieldsPOSAudit['user_id']=strip_tags($request['userId']);
        $incomingFieldsPOSAudit['outlet_id']=strip_tags($request['outletId']);
        $incomingFieldsPOSAudit['visit_id']=strip_tags($request['visitId']);

        if(strlen($incomingFields['products'])>0){

        $posAudit=Posaudit::create($incomingFieldsPOSAudit);
        $posAuditId=$posAudit->id;

        $incomingFieldsPOSAuditItem['posaudit_id']=$posAuditId;

        
        //return $incomingFields['products'];
        $posAuditArray= explode('_',$incomingFields['products']);
        //return json_encode($posAuditArray);

        foreach ($posAuditArray as $productPiecesString) {
            # code...
            $productPiecesSplit=explode('-',$productPiecesString);
            //return $productPiecesSplit;
            $productId=$productPiecesSplit[0];
            $pieces=$productPiecesSplit[1];
            $incomingFieldsPOSAuditItem['product_id']=$productId;
            $incomingFieldsPOSAuditItem['pieces']=$pieces;
            PosauditItem::create($incomingFieldsPOSAuditItem);

        }

        //Posaudit::create($incomingFields);

        $posAuditStatus=array(
            "message" => "POSAudit Added Successful",
            "status" => "success");

        }else{
            $posAuditStatus=array(
                "message" => "POSAudit Product Numbers Missing",
                "status" => "failed");
        }

        return response()->json($posAuditStatus);
        
    }
    public function index(){
        $posAudits = Posaudit::with('user','outlet','visit','posaudititems.product')->get();
        return response()->json(['posAudits'=>$posAudits]);
    }
}
