<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use App\Models\Clockin;

class VisitController extends Controller
{
    //
        //
        public function index() {
            //$visits = Visit::all();
            $visits = Visit::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get();
            return view('visits', ['visits'=>$visits]);
        }

        public function showEditVisit($id){
            //$visit = Visit::find($id);
            $visit=Visit::with(['user' => function ($query) {
                $query->withTrashed();
            }])->get()->find($id);
            return view('edit-visit',['visit'=>$visit]);
        }

        public function showVisitsMap(){

            $visits = Visit::with(['user' => function ($query) {
                $query->withTrashed();
            }, 'outlet'])->get();
           
            //$users = User::inOrganization()->where('usertype','seller')->get();
            return view('visitsmap', compact('visits') );
        }

        public function showVisitsByDay() {
            //$clockins = Clockin::all();
            $clockins = Clockin::with(['user' => function ($query) {
                $query->withTrashed();
            },'visits.outlet'])->get();
    
            return view('visitsbyday', ['clockins'=>$clockins]);
        }

        public function showEditVisitsByDay($id){
            $clockin = Clockin::with(['user' => function ($query) {
                $query->withTrashed();
            },'visits.outlet'])->get()->find($id);
            return view('edit-visitsbyday',compact('clockin'));
        }

        // public function showEditVisit(Request $request){
        //     $incomingFields=$request->validate([
        //         'id'=>'required|numeric|digits_between:1,11'
        //     ]);
        //     $visit = Visit::find($incomingFields['id']);
        //     return view('edit-visit',['visit'=>$visit]);
        // }

}
