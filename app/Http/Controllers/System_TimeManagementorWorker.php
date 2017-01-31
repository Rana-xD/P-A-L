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
      try{
      $locations = DB::table('location_master')
              ->select('location_id','location_name')->get();

      $staff = DB::table('staff_master')
             ->select('staff_name','id')
             ->where('location','=',$locations[0]->location_id)
             ->get();
      $process = DB::table('process_master')->get();
      $default = $locations[0]->location_id;


     return view ('TimemanagementIndividual',compact('default','staff','locations','process'));
  }
  catch(\Exception $e)
      {
         DB::rollback();
         return $error = $e->getMessage();
      }
   }

   // Accepted Ajax Request
   public function get_users_by_location(Request $request, $location){
      if($request->ajax()){
        $staff = DB::table('staff_master')
             ->select('staff_name','id')
             ->where('location','=',$location)
             ->get();
        $process = DB::table('process_master')->get();
        return response()->json(['staff'=> $staff,'process' => $process]);
      }
   }

   // Get specific user info
   public function get_user_info(Request $request, $userid){
    if($request->ajax()){
      $user = DB::table('staff_master')
             ->join('time_shift_master','staff_master.work_shift','=','time_shift_master.id')
             ->select('time_shift_master.time_in','time_shift_master.time_out','time_shift_master.rest')
             ->where('staff_master.id','=',$userid)
             ->get();
      return response()->json(['user'=>$user]);
    }
   }

   //
   public function timeManagement(Request $request)
   {
      $location = $request->location;
      $staff = $request->staff;
      $date = $request->date;
      $date_1  = DateTime::createFromFormat('m/d/Y', $date);
      $newdate = $date_1->format('Y-m-d');
      $exist = DB::table('time_management')
               ->where([
                  ['location',$location],
                  ['staff',$staff],
                  ['date',$newdate]
               ])
               ->get();
      if (empty($exist[0])) {
         DB::beginTransaction();
         try{
         // filter time input
         $start_hour = $request->input('start_hour');
         $start_minute = $request->input('start_minute');
         $stop_hour = $request->input('stop_hour');
         $stop_minute = $request->input('stop_minute');
         $rest_minute = $request->input('rest_minute');

         //find working hour and extra Time
         $start_time = ($start_hour * 60) + $start_minute;
         $end_time = ($stop_hour * 60) + $stop_minute;
         $output['working_hour'] = ($end_time - $start_time - $rest_minute ) / 60;
         if ($output['working_hour'] > 8) {
            $output['actual_work'] = 8;
            $output['over_time'] = $output['working_hour'] - 8 ;
         }
         else {
            $output['actual_work'] =$output['working_hour'];
            $output['over_time'] = 0;
         }
         //define work shift
         if ((6<=$start_hour)&&($start_hour<=24)) {
            $output['work_shift'] = 1;
         }
         else {
            $output['work_shift'] = 2;
         }
         // cocatenate hour with minute
         $start_time = $start_hour.':'.$start_minute;
         $stop_time = $stop_hour.':'.$stop_minute;

         // assign new time
         $output['start_time'] = $start_time;
         $output['stop_time'] = $stop_time;

         // filter only tasks data input
         $data = $request->except(['_token','stop_minute','stop_hour','start_minute','start_hour']);

         // loop through tasks data
         foreach ($data as $key => $value) {
            $output[$key] = $value;
         }
            $output['process'] = '';
           //add process data
           for ($i=6; $i <= 36 ; $i++) {
              for ($j=1; $j <= 4 ; $j++) {
                 if (empty($output['hour_'.$i.'_'.$j])) {
                    $output['process'] = $output['process'].'0,';
                 }
                 else {
                    $output['process'] = $output['process'].$output['hour_'.$i.'_'.$j].',';
                 }
              }
           }
            // return $output;
            DB::table('time_management')->insert(
               ['date' => $newdate,'staff' => $staff,'location' => $location, 'work_shift' => $output['work_shift'], 'start_time' => $output['start_time'], 'end_time' => $output['stop_time'], 'working_hour' => $output['working_hour'],'actual_working_hour' => $output['actual_work'],'overtime_working_hour' => $output['over_time'],'process' => $output['process'],'created_at' => new DateTime]
            );
            DB::commit();
            return "insert";
        }
        catch(\Exception $e)
            {
               DB::rollback();
               return $error = $e->getMessage();
            }
      }
      else {
         DB::beginTransaction();
         try{
         // filter time input
         $start_hour = $request->input('start_hour');
         $start_minute = $request->input('start_minute');
         $stop_hour = $request->input('stop_hour');
         $stop_minute = $request->input('stop_minute');
         $rest_minute = $request->input('rest_minute');

         //find working hour and extra Time
         $start_time = ($start_hour * 60) + $start_minute;
         $end_time = ($stop_hour * 60) + $stop_minute;
         $output['working_hour'] = ($end_time - $start_time - $rest_minute ) / 60;
         if ($output['working_hour'] > 8) {
            $output['actual_work'] = 8;
            $output['over_time'] = $output['working_hour'] - 8 ;
         }
         else {
            $output['actual_work'] =$output['working_hour'];
            $output['over_time'] = 0;
         }
         //define work shift
         if ((6<=$start_hour)&&($start_hour<=24)) {
            $output['work_shift'] = 1;
         }
         else {
            $output['work_shift'] = 2;
         }
         // cocatenate hour with minute
         $start_time = $start_hour.':'.$start_minute;
         $stop_time = $stop_hour.':'.$stop_minute;

         // assign new time
         $output['start_time'] = $start_time;
         $output['stop_time'] = $stop_time;

         // filter only tasks data input
         $data = $request->except(['_token','stop_minute','stop_hour','start_minute','start_hour']);

         // loop through tasks data
         foreach ($data as $key => $value) {
            $output[$key] = $value;
         }
            $output['process'] = '';
           //add process data
           for ($i=6; $i <= 36 ; $i++) {
              for ($j=1; $j <= 4 ; $j++) {
                 if (empty($output['hour_'.$i.'_'.$j])) {
                    $output['process'] = $output['process'].'0,';
                 }
                 else {
                    $output['process'] = $output['process'].$output['hour_'.$i.'_'.$j].',';
                 }
              }
           }
           return $output;
           DB::table('time_management')
              ->where([
                 ['staff',$staff],
                 ['location',$location],
                 ['date',$newdate]
              ])
              ->update(['work_shift' => $output['work_shift'], 'start_time' => $output['start_time'], 'end_time' => $output['stop_time'], 'working_hour' => $output['working_hour'],'actual_working_hour' => $output['actual_work'],'overtime_working_hour' => $output['over_time'],'process' => $output['process'],'updated_at' => new DateTime]);
              DB::commit();
              return "update";
        }
        catch(\Exception $e)
            {
               DB::rollback();
               return $error = $e->getMessage();
            }
      }
   }
}
