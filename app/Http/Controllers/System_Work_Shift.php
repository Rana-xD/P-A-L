<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use Date;
use Validator;
use Input;
use Response;

class System_Work_Shift extends Controller
{



    public function work()
    {
        $month = (int)date("m");
        $year = (int)date("Y");
        if(session_status()===PHP_SESSION_NONE){
            session_start();
            $location = $_SESSION['location'];
        }
        elseif (session_status()===PHP_SESSION_ACTIVE) {
            $location = $_SESSION['location'];
        }
      if($location==0)
      {
          $staff = DB::table('staff_master')
                    ->join('work_shift_master','staff_master.id','=','work_shift_master.staff_id')
                    ->select('staff_master.staff_name','work_shift_master.work_shift')
                    ->where([
                        ['work_shift_master.month','=',$month],
                        ['work_shift_master.year','=',$year],
                        ['staff_master.location','=',1]
                    ])
                    ->get();
        $loc = DB::table('location_master')->select('location_name')->where('location_id','=',$location)->get();
        $locs = $loc[0]->location_name;
        // return $staff;
            foreach ($staff as $index) {
                $index->work_shift = str_split($index->work_shift);
            }

      }
      else {
          $staff = DB::table('staff_master')
                    ->join('work_shift_master','staff_master.id','=','work_shift_master.staff_id')
                    ->select('staff_master.staff_name','work_shift_master.work_shift')
                    ->where([
                        ['work_shift_master.month','=',$month],
                        ['work_shift_master.year','=',$year],
                        ['staff_master.location','=',$location]
                    ])
                    ->get();
          $loc = DB::table('location_master')->select('location_name')->where('location_id','=',$location)->get();
          $locs = $loc[0]->location_name;

      }
      $k = 0;
      if(session_status()===PHP_SESSION_NONE){
         session_start();
        if($_SESSION['role']=='admin'){
          return view ('admin.WorkShift',compact('staff','location','month','year','k','locs'));
        }
        else {
          return view ('manager.WorkShift',compact('staff','location','month','year','k','locs'));
        }
         }
      elseif (session_status()===PHP_SESSION_ACTIVE)
      {
        if($_SESSION['role']=='admin'){
          return view ('admin.WorkShift',compact('staff','location','month','year','k','locs'));
        }
        else {
          return view ('manager.WorkShift',compact('staff','location','month','year','k','locs'));
        }
      }
    }



    public function ajax_work_shift(Request $request)
    {
        if($request->ajax()){
        $month = $request->input('month');
        $year = $request->input('year');
        if(session_status()===PHP_SESSION_NONE){
            session_start();
            $location = $request->input('location');
        }
        elseif (session_status()===PHP_SESSION_ACTIVE) {
            $location = $request->input('location');
        }
      if($location==0)
      {
          $staff = DB::table('staff_master')
                    ->join('work_shift_master','staff_master.id','=','work_shift_master.staff_id')
                    ->select('staff_master.staff_name','work_shift_master.work_shift')
                    ->where([
                        ['work_shift_master.month','=',$month],
                        ['work_shift_master.year','=',$year],
                        ['staff_master.location','=',1]
                    ])
                    ->get();
                    // return $staff;
            foreach ($staff as $index) {
                $index->work_shift = str_split($index->work_shift);
            }

      }
      else {
          $staff = DB::table('staff_master')
                    ->join('work_shift_master','staff_master.id','=','work_shift_master.staff_id')
                    ->select('staff_master.staff_name','work_shift_master.work_shift')
                    ->where([
                        ['work_shift_master.month','=',$month],
                        ['work_shift_master.year','=',$year],
                        ['staff_master.location','=',$location]
                    ])
                    ->get();
                    foreach ($staff as $index) {
                        $index->work_shift = str_split($index->work_shift);
                    }
      }
      $k = 0;


          return response()->json([
              'staff' => $staff,
              'location' => $location,
              'month'=> $month,
              'year'=> $year,
              'k'=> $k
          ]);


      }

    }

}
