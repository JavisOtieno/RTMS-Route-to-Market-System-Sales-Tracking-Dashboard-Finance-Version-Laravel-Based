<?php

namespace App\Http\Controllers;

use App\Models\Posaudit;
use App\Models\PosauditItem;
use Illuminate\Http\Request;

class PosauditController extends Controller
{
    //

    public function index() {
        //$posaudits = Posaudit::all();
        //$posaudits = Posaudit::with('user','outlet','visit','posaudititems.product')->get();
        $posaudits = Posaudit::with(['user' => function ($query) {
            $query->withTrashed();
        }, 'visit','outlet','posaudititems' => function ($query) {
        $query->with(['product' => function ($query) {
            $query->withTrashed();
        }]);
    }])->get();
        return view('posaudits', ['posaudits'=>$posaudits]);
    }

    public function showPOSAuditsById($objectId,$object) {

        //$posaudits = Posaudit::all();
        //$posaudits = Posaudit::with('user','outlet','visit','posaudititems.product')->get();
        if ($object === 'clockin') {
            // Fetch POS audits based on clockin ID via visits
            $posaudits = Posaudit::whereHas('visit', function ($query) use ($objectId) {
                $query->where('clockin_id', $objectId);
            })->with(['user' => function ($query) {
                $query->withTrashed();
            }, 'visit', 'outlet', 'posaudititems' => function ($query) {
                $query->with(['product' => function ($query) {
                    $query->withTrashed();
                }]);
            }])->get();
        } else {
        $posaudits = Posaudit::with(['user' => function ($query) {
            $query->withTrashed();
        }, 'visit','outlet','posaudititems' => function ($query) {
        $query->with(['product' => function ($query) {
            $query->withTrashed();
        }]);
    }])->where($object.'_id',$objectId)->get();
    }
        return view('posaudits', ['posaudits'=>$posaudits]);
    }



    public function deletePosaudit($id){
        $posaudit = Posaudit::find($id);
        $posaudit->delete();
        return redirect('/posaudits');
    }

    public function showEditPOSAudit($id){
        //$posaudit = Posaudit::find($id);
        $posaudit = Posaudit::with(['user' => function ($query) {
            $query->withTrashed();
        },
        'posaudititems' => function ($query) {
        $query->with(['product' => function ($query) {
            $query->withTrashed();
        }]);
        }
        ])->get()->find($id);
        return view('edit-posaudit',['posaudit'=>$posaudit]);
    }
    public function saveEditPOSAudit($id,Request $request){
        
        //$posaudit = Posaudit::find($id);
        $productPieces = $request->input('productPieces'); // This will be an associative array with posaudititem IDs as keys

        foreach ($productPieces as $id => $pieces) {
            // Update the posaudititem with the given ID
            $posaudititem = PosAuditItem::find($id);
            if ($posaudititem) {
                $posaudititem->pieces = $pieces;
                $posaudititem->save();
            }
        }

        return redirect('/posaudits');
        
    }

    // public function showEditPOSAudit(Request $request){
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $posaudit = Posaudit::find($incomingFields['id']);
    //     return view('edit-posaudit',['posaudit'=>$posaudit]);
    // }


}
