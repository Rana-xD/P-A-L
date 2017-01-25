<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use Date;
use Validator;
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
        // return $staff;

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

      }
      $k = 0;
      if(session_status()===PHP_SESSION_NONE){
         session_start();
        if($_SESSION['role']=='admin'){
          return view ('admin.WorkShift',compact('staff','location','month','year','k'));
        }
        else {
          return view ('manager.WorkShift',compact('staff','location','month','year','k'));
        }
         }
      elseif (session_status()===PHP_SESSION_ACTIVE)
      {
        if($_SESSION['role']=='admin'){
          return view ('admin.WorkShift',compact('staff','location','month','year','k'));
        }
        else {
          return view ('manager.WorkShift',compact('staff','location','month','year','k'));
        }
      }
    }
}
