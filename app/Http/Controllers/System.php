<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class System extends Controller
{
    public function kpi()
    {
        $accidents = DB::table('accident_master')->get()->all();
        $categories = DB::table('category_master')
        ->join('unit_price_master','category_master.category_id','=','unit_price_master.category')
        ->select('category_master.category_name','unit_price_master.UOP')
        ->where('unit_price_master.location_id','=', 2)
        ->get();
        $i = 0;
        $j = 0;
        if(session_status()===PHP_SESSION_NONE){
             session_start();
            if($_SESSION['role']=='admin'){
              return view ('admin.L-KPI',compact('accidents','categories','i','j'));
            }
            else {
              return view ('admin.L-KPI',compact('accidents','categories','i','j'));
            }
             }
          elseif (session_status()===PHP_SESSION_ACTIVE)
          {
            if($_SESSION['role']=='admin'){
              return view ('admin.L-KPI',compact('accidents','categories','i','j'));
            }
            else {
              return view ('admin.L-KPI',compact('accidents','categories','i','j'));
            }
          }
    }
}
