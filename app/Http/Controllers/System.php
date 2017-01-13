<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use Validator;

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
        $flag = 0;
        $error = 0;
        $date = 0;
        if(session_status()===PHP_SESSION_NONE){
             session_start();

              return view ('manager.L-KPI',compact('accidents','categories','i','j','flag','error','date'));
             }
          elseif (session_status()===PHP_SESSION_ACTIVE)
          {
            return view ('manager.L-KPI',compact('accidents','categories','i','j','flag','error','date'));
          }
    }
    public function kpiData(Request $request)
    {

        if(session_status()===PHP_SESSION_NONE){
             session_start();
             $location = $_SESSION['location'];
         }
         elseif (session_status()===PHP_SESSION_ACTIVE) {
             $location = $_SESSION['location'];
         }
         if ($location == 1)
         {
             $validator = Validator::make($request->all(), [
             'date' => 'required',
             ]);


         if ($validator->fails()) {
             $accidents = DB::table('accident_master')->get()->all();
              $categories = DB::table('category_master')
              ->join('unit_price_master','category_master.category_id','=','unit_price_master.category')
              ->select('category_master.category_name','unit_price_master.UOP')
              ->where('unit_price_master.location_id','=', $location)
              ->get();
              $i = 0;
              $j = 0;
              $flag = 0;
              $error = 0;
              $date = 1;
              return view ('manager.L-KPI',compact('accidents','categories','i','j','flag','error','date'));
         }



             $date = $request->date;

             //convert string date into milisecond
             $date_mini = strtotime($date);
             $current_date_mini = strtotime($request->current_date);

             //check if user try to input data in advance date
             if($date_mini > $current_date_mini)
             {
                 $accidents = DB::table('accident_master')->get()->all();
                 $categories = DB::table('category_master')
                 ->join('unit_price_master','category_master.category_id','=','unit_price_master.category')
                 ->select('category_master.category_name','unit_price_master.UOP')
                 ->where('unit_price_master.location_id','=', $location)
                 ->get();
                 $i = 0;
                 $j = 0;
                 $flag = 0;
                 $error = 1;
                 $date = 0;
                 return view ('manager.L-KPI',compact('accidents','categories','i','j','flag','error','date'));
             }
             $date_1  = DateTime::createFromFormat('m/d/Y', $date);
             $newdate = $date_1->format('Y-m-d');

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
             // check whether data come from first part or second part
             if(empty($data['quantity-1']))
             {
                 $output['category-1'] = $data['category-1'];
                 $output['quantity-1'] = (int)$data['quantity-a-1'];
                 $output['total-uop-1'] = (int)$data['total-uop-a-1'];
                 $output['tag-1'] = 2;
             }
             else {
                 $output['category-1'] = $data['category-1'];
                 $output['quantity-1'] = (int)$data['quantity-1'];
                 $output['total-uop-1'] = (int)$data['total-uop-1'];
                 $output['tag-1'] = 1;
             }
             if(empty($data['quantity-2']))
             {
                 $output['category-2'] = $data['category-2'];
                 $output['quantity-2'] = (int)$data['quantity-a-2'];
                 $output['total-uop-2'] = (int)$data['total-uop-a-2'];
                 $output['tag-2'] = 2;
             }
             else {

                 $output['category-2'] = $data['category-2'];
                 $output['quantity-2'] = (int)$data['quantity-2'];
                 $output['total-uop-2'] = (int)$data['total-uop-2'];
                 $output['tag-2'] = 1;
             }
             if(empty($data['quantity-3']))
             {
                 $output['category-3'] = $data['category-3'];
                 $output['quantity-3'] = (int)$data['quantity-a-3'];
                 $output['total-uop-3'] = (int)$data['total-uop-a-3'];
                 $output['tag-3'] = 2;
             }
             else {

                 $output['category-3'] = $data['category-3'];
                 $output['quantity-3'] = (int)$data['quantity-3'];
                 $output['total-uop-3'] = (int)$data['total-uop-3'];
                 $output['tag-3'] = 1;
             }
             if(empty($data['quantity-4']))
             {
                 $output['category-4'] = $data['category-4'];
                 $output['quantity-4'] = (int)$data['quantity-a-4'];
                 $output['total-uop-4'] = (int)$data['total-uop-a-4'];
                 $output['tag-4'] = 2;
             }
             else {

                 $output['category-4'] = $data['category-4'];
                 $output['quantity-4'] = (int)$data['quantity-4'];
                 $output['total-uop-4'] = (int)$data['total-uop-4'];
                 $output['tag-4'] = 1;
             }
             if(empty($data['quantity-5']))
             {
                 $output['category-5'] = $data['category-5'];
                 $output['quantity-5'] = (int)$data['quantity-a-5'];
                 $output['total-uop-5'] = (int)$data['total-uop-a-5'];
                 $output['tag-5'] = 2;
             }
             else {

                 $output['category-5'] = $data['category-5'];
                 $output['quantity-5'] = (int)$data['quantity-5'];
                 $output['total-uop-5'] = (int)$data['total-uop-5'];
                 $output['tag-5'] = 1;
             }

             for ($i=1; $i < 6; $i++) {
                 $output['accident-'.$i] = $data['accident-'.$i];
                 $output['quantity-buy-'.$i] = $data['quantity-buy-'.$i];
             }
             // insert data to accident table
             DB::beginTransaction();
             try{
                 for ($i=1; $i < 6; $i++) {
                     $result = DB::table('accident_master')->where('accident_type','=', $output['accident-'.$i])->select('id')->get();
                     $id = $result[0]->id;
                     DB::table('accident')->insert(
                       ['location' => $location, 'date' => $newdate, 'accident' => $id, '#of_quantity_tobuy' => $output['quantity-buy-'.$i], 'created_at' => new DateTime]
                     );
                 }
             }
             catch(\Exception $e)
             {
                //  DB::rollback();
                 $error = $e->getMessage();
                 return $error;
      }


            // insert data to daily progress table
            for ($i=1; $i < 6; $i++) {
                $result = DB::table('category_master')->where('category_name','=', $output['category-'.$i])->select('category_id')->get();
                $id = $result[0]->category_id;
                DB::table('daily_progress')->insert(
                    ['location' => $location, 'date' => $newdate, 'category' => $id, 'quantity' => $output['quantity-'.$i], 'price' => $output['total-uop-'.$i], 'tag' => $output['tag-'.$i], 'created_at' => new DateTime]
                );
            }
            //add end time to endtime table
            DB::table('endtime')->insert(
                    ['location' => $location, 'date' => $newdate, 'end_time_1' => $stop_time_1, 'end_time_2' => $stop_time_2,'end_time_3' => $stop_time_3, 'end_time_4' => $stop_time_4, 'created_at' => new DateTime]
            );

            // return to L-KPI page and notify that it is done
            $accidents = DB::table('accident_master')->get()->all();
            $categories = DB::table('category_master')
            ->join('unit_price_master','category_master.category_id','=','unit_price_master.category')
            ->select('category_master.category_name','unit_price_master.UOP')
            ->where('unit_price_master.location_id','=', $location)
            ->get();
            $i = 0;
            $j = 0;
            $flag = 1;
            $error = 0;
            $date = 0;
            return view ('manager.L-KPI',compact('accidents','categories','i','j','flag','error','date'));

         }
         elseif ($location == 2) {

             $validator = Validator::make($request->all(), [
             'date' => 'required',
             ]);


         if ($validator->fails()) {
             $accidents = DB::table('accident_master')->get()->all();
              $categories = DB::table('category_master')
              ->join('unit_price_master','category_master.category_id','=','unit_price_master.category')
              ->select('category_master.category_name','unit_price_master.UOP')
              ->where('unit_price_master.location_id','=', $location)
              ->get();
              $i = 0;
              $j = 0;
              $flag = 0;
              $error = 0;
              $date = 1;
              return view ('manager.L-KPI',compact('accidents','categories','i','j','flag','error','date'));
         }

             $date = $request->date;

             //convert string date into milisecond
             $date_mini = strtotime($date);
             $current_date_mini = strtotime($request->current_date);

             //check if user try to input data in advance date
             if($date_mini > $current_date_mini)
             {
                 $accidents = DB::table('accident_master')->get()->all();
                 $categories = DB::table('category_master')
                 ->join('unit_price_master','category_master.category_id','=','unit_price_master.category')
                 ->select('category_master.category_name','unit_price_master.UOP')
                 ->where('unit_price_master.location_id','=', $location)
                 ->get();
                 $i = 0;
                 $j = 0;
                 $flag = 0;
                 $error = 1;
                 $date = 0;
                 return view ('manager.L-KPI',compact('accidents','categories','i','j','flag','error','date'));
             }
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

             // check whether data come from first part or second part
             if(empty($data['quantity-1']))
             {
                 $output['category-1'] = $data['category-1'];
                 $output['quantity-1'] = (int)$data['quantity-a-1'];
                 $output['total-uop-1'] = (int)$data['total-uop-a-1'];
                 $output['tag-1'] = 2;
             }
             else {
                 $output['category-1'] = $data['category-1'];
                 $output['quantity-1'] = (int)$data['quantity-1'];
                 $output['total-uop-1'] = (int)$data['total-uop-1'];
                 $output['tag-1'] = 1;
             }
             if(empty($data['quantity-2']))
             {
                 $output['category-2'] = $data['category-2'];
                 $output['quantity-2'] = (int)$data['quantity-a-2'];
                 $output['total-uop-2'] = (int)$data['total-uop-a-2'];
                 $output['tag-2'] = 2;
             }
             else {

                 $output['category-2'] = $data['category-2'];
                 $output['quantity-2'] = (int)$data['quantity-2'];
                 $output['total-uop-2'] = (int)$data['total-uop-2'];
                 $output['tag-2'] = 1;
             }
             if(empty($data['quantity-3']))
             {
                 $output['category-3'] = $data['category-3'];
                 $output['quantity-3'] = (int)$data['quantity-a-3'];
                 $output['total-uop-3'] = (int)$data['total-uop-a-3'];
                 $output['tag-3'] = 2;
             }
             else {

                 $output['category-3'] = $data['category-3'];
                 $output['quantity-3'] = (int)$data['quantity-3'];
                 $output['total-uop-3'] = (int)$data['total-uop-3'];
                 $output['tag-3'] = 1;
             }
             if(empty($data['quantity-4']))
             {
                 $output['category-4'] = $data['category-4'];
                 $output['quantity-4'] = (int)$data['quantity-a-4'];
                 $output['total-uop-4'] = (int)$data['total-uop-a-4'];
                 $output['tag-4'] = 2;
             }
             else {

                 $output['category-4'] = $data['category-4'];
                 $output['quantity-4'] = (int)$data['quantity-4'];
                 $output['total-uop-4'] = (int)$data['total-uop-4'];
                 $output['tag-4'] = 1;
             }
             if(empty($data['quantity-5']))
             {
                 $output['category-5'] = $data['category-5'];
                 $output['quantity-5'] = (int)$data['quantity-a-5'];
                 $output['total-uop-5'] = (int)$data['total-uop-a-5'];
                 $output['tag-5'] = 2;
             }
             else {

                 $output['category-5'] = $data['category-5'];
                 $output['quantity-5'] = (int)$data['quantity-5'];
                 $output['total-uop-5'] = (int)$data['total-uop-5'];
                 $output['tag-5'] = 1;
             }
             if(empty($data['quantity-6']))
             {
                 $output['category-6'] = $data['category-6'];
                 $output['quantity-6'] = (int)$data['quantity-a-6'];
                 $output['total-uop-6'] = (int)$data['total-uop-a-6'];
                 $output['tag-6'] = 2;
             }
             else {

                 $output['category-6'] = $data['category-6'];
                 $output['quantity-6'] = (int)$data['quantity-6'];
                 $output['total-uop-6'] = (int)$data['total-uop-6'];
                 $output['tag-6'] = 1;
             }
             if(empty($data['quantity-7']))
             {
                 $output['category-7'] = $data['category-7'];
                 $output['quantity-7'] = (int)$data['quantity-a-7'];
                 $output['total-uop-7'] = (int)$data['total-uop-a-7'];
                 $output['tag-7'] = 2;
             }
             else {

                 $output['category-7'] = $data['category-7'];
                 $output['quantity-7'] = (int)$data['quantity-7'];
                 $output['total-uop-7'] = (int)$data['total-uop-7'];
                 $output['tag-7'] = 1;
             }
             if(empty($data['quantity-8']))
             {
                 $output['category-8'] = $data['category-8'];
                 $output['quantity-8'] = (int)$data['quantity-a-8'];
                 $output['total-uop-8'] = (int)$data['total-uop-a-8'];
                 $output['tag-8'] = 2;
             }
             else {

                 $output['category-8'] = $data['category-8'];
                 $output['quantity-8'] = (int)$data['quantity-8'];
                 $output['total-uop-8'] = (int)$data['total-uop-8'];
                 $output['tag-8'] = 1;
             }
             if(empty($data['quantity-9']))
             {
                 $output['category-9'] = $data['category-9'];
                 $output['quantity-9'] = (int)$data['quantity-a-9'];
                 $output['total-uop-9'] = (int)$data['total-uop-a-9'];
                 $output['tag-9'] = 2;
             }
             else {

                 $output['category-9'] = $data['category-9'];
                 $output['quantity-9'] = (int)$data['quantity-9'];
                 $output['total-uop-9'] = (int)$data['total-uop-9'];
                 $output['tag-9'] = 1;
             }
             if(empty($data['quantity-10']))
             {
                 $output['category-10'] = $data['category-10'];
                 $output['quantity-10'] = (int)$data['quantity-a-10'];
                 $output['total-uop-10'] = (int)$data['total-uop-a-10'];
                 $output['tag-10'] = 2;
             }
             else {

                 $output['category-10'] = $data['category-10'];
                 $output['quantity-10'] = (int)$data['quantity-10'];
                 $output['total-uop-10'] = (int)$data['total-uop-10'];
                 $output['tag-10'] = 1;
             }
             if(empty($data['quantity-11']))
             {
                 $output['category-11'] = $data['category-11'];
                 $output['quantity-11'] = (int)$data['quantity-a-11'];
                 $output['total-uop-11'] = (int)$data['total-uop-a-11'];
                 $output['tag-11'] = 2;
             }
             else {

                 $output['category-11'] = $data['category-11'];
                 $output['quantity-11'] = (int)$data['quantity-11'];
                 $output['total-uop-11'] = (int)$data['total-uop-11'];
                 $output['tag-11'] = 1;
             }
             if(empty($data['quantity-12']))
             {
                 $output['category-12'] = $data['category-12'];
                 $output['quantity-12'] = (int)$data['quantity-a-12'];
                 $output['total-uop-12'] = (int)$data['total-uop-a-12'];
                 $output['tag-12'] = 2;
             }
             else {
                 $output['category-12'] = $data['category-12'];
                 $output['quantity-12'] = (int)$data['quantity-12'];
                 $output['total-uop-12'] = (int)$data['total-uop-12'];
                 $output['tag-12'] = 1;
             }
             if(empty($data['quantity-13']))
             {
                 $output['category-13'] = $data['category-13'];
                 $output['quantity-13'] = (int)$data['quantity-a-13'];
                 $output['total-uop-13'] = (int)$data['total-uop-a-13'];
                 $output['tag-13'] = 2;
             }
             else {
                 $output['category-13'] = $data['category-13'];
                 $output['quantity-13'] = (int)$data['quantity-13'];
                 $output['total-uop-13'] = (int)$data['total-uop-13'];
                 $output['tag-13'] = 1;
             }
             if(empty($data['quantity-14']))
             {
                 $output['category-14'] = $data['category-14'];
                 $output['quantity-14'] = (int)$data['quantity-a-14'];
                 $output['total-uop-14'] = (int)$data['total-uop-a-14'];
                 $output['tag-14'] = 2;
             }
             else {
                 $output['category-14'] = $data['category-14'];
                 $output['quantity-14'] = (int)$data['quantity-14'];
                 $output['total-uop-14'] = (int)$data['total-uop-14'];
                 $output['tag-14'] = 1;
             }

             for ($i=1; $i < 6; $i++) {
                 $output['accident-'.$i] = $data['accident-'.$i];
                 $output['quantity-buy-'.$i] = $data['quantity-buy-'.$i];
             }
             // insert data to accident table
             for ($i=1; $i < 6; $i++) {
                 $result = DB::table('accident_master')->where('accident_type','=', $output['accident-'.$i])->select('id')->get();
                 $id = $result[0]->id;
                 DB::table('accident')->insert(
                   ['location' => $location, 'date' => $date, 'accident' => $id, '#of_quantity_tobuy' => $output['quantity-buy-'.$i], 'created_at' => new DateTime]
                 );
             }
             // insert data to daily progress table
             for ($i=1; $i < 15; $i++) {
                 $result = DB::table('category_master')->where('category_name','=', $output['category-'.$i])->select('category_id')->get();
                 $id = $result[0]->category_id;
                 DB::table('daily_progress')->insert(
                     ['location' => $location, 'date' => $date, 'category' => $id, 'quantity' => $output['quantity-'.$i], 'price' => $output['total-uop-'.$i], 'tag' => $output['tag-'.$i], 'created_at' => new DateTime]
                 );
             }
             // insert end time to endtime table
             DB::table('endtime')->insert(
                     ['location' => $location, 'date' => $date, 'end_time_1' => $stop_time_1, 'end_time_2' => $stop_time_2,'end_time_3' => $stop_time_3, 'end_time_4' => $stop_time_4, 'created_at' => new DateTime]
             );

             // return to L-KPI page and notify that it is done
             $accidents = DB::table('accident_master')->get()->all();
             $categories = DB::table('category_master')
             ->join('unit_price_master','category_master.category_id','=','unit_price_master.category')
             ->select('category_master.category_name','unit_price_master.UOP')
             ->where('unit_price_master.location_id','=', $location)
             ->get();
             $i = 0;
             $j = 0;
             $flag = 1;
             $error = 0;
             $date = 0;
             return view ('manager.L-KPI',compact('accidents','categories','i','j','flag','error','date'));


         }

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
