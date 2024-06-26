<?php

namespace App\Http\Controllers;

use App\Models\Posaudit;
use Illuminate\Http\Request;

class PosauditController extends Controller
{
    //

    public function index() {
        //$posaudits = Posaudit::all();
        $posaudits = Posaudit::with('user','outlet','visit','posaudititems.product')->get();
        return view('posaudits', ['posaudits'=>$posaudits]);
    }

    public function deletePosaudit($id){
        $posaudit = Posaudit::find($id);
        $posaudit->delete();
        return redirect('/posaudits');
    }

    public function showEditPOSAudit($id){
        $posaudit = Posaudit::find($id);
        return view('edit-posaudit',['posaudit'=>$posaudit]);
    }

    // public function showEditPOSAudit(Request $request){
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $posaudit = Posaudit::find($incomingFields['id']);
    //     return view('edit-posaudit',['posaudit'=>$posaudit]);
    // }


}
