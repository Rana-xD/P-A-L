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
       $location = DB::table('location_master')
               ->select('location_id')
               ->where('location_id','=',2)->get();
       $staff = DB::table('staff_master')
               ->select('staff_id','staff_name')
               ->where('location','=',$location[0]->location_id)
               ->get();
       return view ('TimemanagementIndividual',compact('location','staff'));
     }
}
