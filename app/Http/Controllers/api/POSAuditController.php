<?php

namespace App\Http\Controllers\api;

use App\Models\Posaudit;
use App\Models\PosauditItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class POSAuditController extends Controller
{
    //

    public function savePOSAudit(Request $request){

       
        // $incomingFields=
        $request->validate([
            'userId'=>'required|numeric|digits_between:1,20|exists:users,id',
            'outletId'=>'required|numeric|digits_between:1,20|exists:outlets,id',
            'visitId'=>'required|numeric|digits_between:1,20|exists:visits,id',
            'products'=>'required'
        //     'userId'=>'required',
        //     'time'=>'required',
        //     'lat'=>'required',
        //     'long'=>'required'
        ]);

        //Test Git


        $incomingFields=[];
        $incomingFields['products']=strip_tags($request['products']);
        $incomingFieldsPOSAudit['user_id']=strip_tags($request['userId']);
        $incomingFieldsPOSAudit['outlet_id']=strip_tags($request['outletId']);
        $incomingFieldsPOSAudit['visit_id']=strip_tags($request['visitId']);
        $incomingFieldsPOSAudit['image']="";
        $incomingFieldsPOSAudit['organization_id']=auth()->user()->organization_id;
        $incomingFieldsPOSAudit['team_id']=auth()->user()->team_id;


        if(strlen($incomingFields['products'])>0){

        $posAuditStatus=DB::transaction(function () use($incomingFields,
        $incomingFieldsPOSAudit) {

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


            $posAudit=PosauditItem::create($incomingFieldsPOSAuditItem);

        }

        //Posaudit::create($incomingFields);

        $posAuditStatus=array(
            "message" => "POSAudit Added Successful",
            "posAuditId" => $posAuditId,
            "status" => "success"
        );

        return $posAuditStatus;

        });

        }else{
            $posAuditStatus=array(
                "message" => "POSAudit Product Numbers Missing",
                "status" => "failed");
        }

        return response()->json($posAuditStatus);
        

    }
    public function index(){
        $userId = auth()->id();
        $posAudits = Posaudit::where('user_id',$userId)->orderBy('id', 'DESC')->with('user','outlet','visit','posaudititems.product')->get();
        return response()->json(['posAudits'=>$posAudits]);
    }
    public function visitPOSAudits(Request $request){
        //$sales = Sale::all();
        $incomingFields=$request->validate([
            'visitId'=>'required',
        ]);
        $visitId=strip_tags($request['visitId']);

        $userId = auth()->id();
        $posaudits = Posaudit::where('visit_id', $visitId)->where('user_id',$userId)->with('user','visit','outlet','posaudititems.product')->orderBy('id', 'DESC')->get();
        return response()->json(['posaudits'=>$posaudits]);
    }
}
