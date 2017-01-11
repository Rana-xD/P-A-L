<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class System extends Controller
{
    public function kpi()
    {
        if(session_status()===PHP_SESSION_NONE){
          session_start();
          $location = $_SESSION['location'];
        }
        elseif (session_status()===PHP_SESSION_ACTIVE) {
          $location = $_SESSION['location'];
        }
        $accidents = DB::table('accident_master')->get()->all();
        $categories = DB::table('category_master')
        ->join('unit_price_master','category_master.category_id','=','unit_price_master.category')
        ->select('category_master.category_name','unit_price_master.UOP')
        ->where('unit_price_master.location_id','=', $location)
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
    public function kpiData(Request $request)
    {
        // return $request->all();

        // filter time input
        $stop_hour_1 = $request->input('stop_hour_1');
        $stop_minute_1 = $request->input('stop_minute_1');
        $stop_hour_2 = $request->input('stop_hour_2');
        $stop_minute_2 = $request->input('stop_minute_2');
        $stop_hour_3 = $request->input('stop_hour_3');
        $stop_minute_3 = $request->input('stop_minute_3');
        $stop_hour_4 = $request->input('stop_hour_4');
        $stop_minute_4 = $request->input('stop_minute_4');

        // cocatenate hour with minute
        $stop_time_1 = $stop_hour_1.':'.$stop_minute_1;
        $stop_time_2 = $stop_hour_2.':'.$stop_minute_2;
        $stop_time_3 = $stop_hour_3.':'.$stop_minute_3;
        $stop_time_4 = $stop_hour_4.':'.$stop_minute_2;

        // filter only tasks data input
        $data = $request->except(['_token','stop_hour_1','stop_hour_2','stop_hour_3','stop_hour_4','stop_minute_1','stop_minute_2','stop_minute_3','stop_minute_4','files']);

        // loop through tasks data
        foreach ($data as $key => $value) {
            $output[$key] = $value;
        }

        // assign new time
        $output['stop_time_1'] = $stop_time_1;
        $output['stop_time_2'] = $stop_time_2;
        $output['stop_time_3'] = $stop_time_3;
        $output['stop_time_4'] = $stop_time_4;

        return $output;
    }

    public function budget()
    {
      $area_west = DB::table('location_master')
                    ->select('location_name')
                    ->where('area_id','=',1)
                    ->get()
                    ->all();
      if(session_status()===PHP_SESSION_NONE){
         session_start();
        if($_SESSION['role']=='admin'){
          return view ('admin.BudgetManagement',compact('area_west'));
        }
        else {
          return view ('manager.BudgetManagement',compact('area_west'));
        }
         }
      elseif (session_status()===PHP_SESSION_ACTIVE)
      {
        if($_SESSION['role']=='admin'){
          return view ('admin.BudgetManagement',compact('area_west'));
        }
        else {
          return view ('manager.BudgetManagement',compact('area_west'));
        }
      }
    }
}
