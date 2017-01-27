<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use Date;
use Validator;
use Input;
use Response;

class System_TimeManagementorWorker extends Controller
{
   public function info()
   {
     $locations = DB::table('location_master')
              ->select('location_id','location_name')->get();

     $staff = DB::table('staff_master')
             ->select('staff_name','id')
             ->where('location','=',$locations[0]->location_id)
             ->get();
     $default = $locations[0]->location_id;

     return view ('TimemanagementIndividual',compact('default','staff','locations'));
   }

   // Accepted Ajax Request
   public function get_users_by_location(Request $request, $location){
      if($request->ajax()){
        $staff = DB::table('staff_master')
             ->select('staff_name','id')
             ->where('location','=',$location)
             ->get();
        return response()->json(['staff'=> $staff]);
      }
   }

   // Get specific user info
   public function get_user_info(Request $request, $userid){
    if($request->ajax()){
      $user = DB::table('staff_master')
             ->where('id','=',$userid)
             ->get();
      return response()->json(['user'=>$user]);
    }
   }

}
