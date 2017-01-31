<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use Date;
use Validator;

class System_KPI extends Controller
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


             $date = $request->date;

             //convert date into mysql format
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
             if(empty($data['quantity_1']))
             {
                 $output['category-1'] = $data['category_1'];
                 $output['quantity-1'] = (int)$data['quantity_a_1'];
                 $output['total-uop-1'] = (int)$data['total_uop_a_1'];
                 $output['tag-1'] = 2;
             }
             else {
                 $output['category-1'] = $data['category_1'];
                 $output['quantity-1'] = (int)$data['quantity_1'];
                 $output['total-uop-1'] = (int)$data['total_uop_1'];
                 $output['tag-1'] = 1;
             }
             if(empty($data['quantity_2']))
             {
                 $output['category-2'] = $data['category_2'];
                 $output['quantity-2'] = (int)$data['quantity_a_2'];
                 $output['total-uop-2'] = (int)$data['total_uop_a_2'];
                 $output['tag-2'] = 2;
             }
             else {

                 $output['category-2'] = $data['category_2'];
                 $output['quantity-2'] = (int)$data['quantity_2'];
                 $output['total-uop-2'] = (int)$data['total_uop_2'];
                 $output['tag-2'] = 1;
             }
             if(empty($data['quantity_3']))
             {
                 $output['category-3'] = $data['category_3'];
                 $output['quantity-3'] = (int)$data['quantity_a_3'];
                 $output['total-uop-3'] = (int)$data['total_uop_a_3'];
                 $output['tag-3'] = 2;
             }
             else {

                 $output['category-3'] = $data['category_3'];
                 $output['quantity-3'] = (int)$data['quantity_3'];
                 $output['total-uop-3'] = (int)$data['total_uop_3'];
                 $output['tag-3'] = 1;
             }
             if(empty($data['quantity_4']))
             {
                 $output['category-4'] = $data['category_4'];
                 $output['quantity-4'] = (int)$data['quantity_a_4'];
                 $output['total-uop-4'] = (int)$data['total_uop_a_4'];
                 $output['tag-4'] = 2;
             }
             else {

                 $output['category-4'] = $data['category_4'];
                 $output['quantity-4'] = (int)$data['quantity_4'];
                 $output['total-uop-4'] = (int)$data['total_uop_4'];
                 $output['tag-4'] = 1;
             }
             if(empty($data['quantity_5']))
             {
                 $output['category-5'] = $data['category-5'];
                 $output['quantity-5'] = (int)$data['quantity_a_5'];
                 $output['total-uop-5'] = (int)$data['total_uop_a_5'];
                 $output['tag-5'] = 2;
             }
             else {

                 $output['category-5'] = $data['category_5'];
                 $output['quantity-5'] = (int)$data['quantity_5'];
                 $output['total-uop-5'] = (int)$data['total_uop_5'];
                 $output['tag-5'] = 1;
             }

             for ($i=1; $i < 13; $i++) {
                 $output['accident-'.$i] = $data['accident_'.$i];
                 $output['quantity-buy-'.$i] = (int)$data['quantity_buy_'.$i];
                 $output['amount-'.$i] = (double)$data['amount_to_pay_'.$i];
                 $output['comment-'.$i] = $data['comment_'.$i];
             }
             // insert data to accident table
                 for ($i=1; $i < 13; $i++) {
                     $result = DB::table('accident_master')->where('accident_type','=', $output['accident-'.$i])->select('id')->get();
                     $id = $result[0]->id;
                     DB::table('accident')->insert(
                       ['location' => $location, 'date' => $newdate, 'accident' => $id, '#of_quantity_tobuy' => $output['quantity-buy-'.$i],'amount' => $output['amount-'.$i],'comment' => $output['comment-'.$i] , 'created_at' => new DateTime]
                     );
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

             $date = $request->date;

             //convert string date into milisecond
             $date_mini = strtotime($date);
             $current_date_mini = strtotime($request->current_date);


             //convert date into mysql format
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
             if(empty($data['quantity_1']))
             {
                 $output['category-1'] = $data['category_1'];
                 $output['quantity-1'] = (int)$data['quantity_a_1'];
                 $output['total-uop-1'] = (int)$data['total_uop_a_1'];
                 $output['tag-1'] = 2;
             }
             else {
                 $output['category-1'] = $data['category_1'];
                 $output['quantity-1'] = (int)$data['quantity_1'];
                 $output['total-uop-1'] = (int)$data['total_uop_1'];
                 $output['tag-1'] = 1;
             }
             if(empty($data['quantity_2']))
             {
                 $output['category-2'] = $data['category_2'];
                 $output['quantity-2'] = (int)$data['quantity_a_2'];
                 $output['total-uop-2'] = (int)$data['total_uop_a_2'];
                 $output['tag-2'] = 2;
             }
             else {

                 $output['category-2'] = $data['category_2'];
                 $output['quantity-2'] = (int)$data['quantity_2'];
                 $output['total-uop-2'] = (int)$data['total_uop_2'];
                 $output['tag-2'] = 1;
             }
             if(empty($data['quantity_3']))
             {
                 $output['category-3'] = $data['category_3'];
                 $output['quantity-3'] = (int)$data['quantity_a_3'];
                 $output['total-uop-3'] = (int)$data['total_uop_a_3'];
                 $output['tag-3'] = 2;
             }
             else {

                 $output['category-3'] = $data['category_3'];
                 $output['quantity-3'] = (int)$data['quantity_3'];
                 $output['total-uop-3'] = (int)$data['total_uop_3'];
                 $output['tag-3'] = 1;
             }
             if(empty($data['quantity_4']))
             {
                 $output['category-4'] = $data['category_4'];
                 $output['quantity-4'] = (int)$data['quantity_a_4'];
                 $output['total-uop-4'] = (int)$data['total_uop_a_4'];
                 $output['tag-4'] = 2;
             }
             else {

                 $output['category-4'] = $data['category_4'];
                 $output['quantity-4'] = (int)$data['quantity_4'];
                 $output['total-uop-4'] = (int)$data['total_uop_4'];
                 $output['tag-4'] = 1;
             }
             if(empty($data['quantity_5']))
             {
                 $output['category-5'] = $data['category_5'];
                 $output['quantity-5'] = (int)$data['quantity_a_5'];
                 $output['total-uop-5'] = (int)$data['total_uop_a_5'];
                 $output['tag-5'] = 2;
             }
             else {

                 $output['category-5'] = $data['category_5'];
                 $output['quantity-5'] = (int)$data['quantity_5'];
                 $output['total-uop-5'] = (int)$data['total_uop_5'];
                 $output['tag-5'] = 1;
             }
             if(empty($data['quantity_6']))
             {
                 $output['category-6'] = $data['category_6'];
                 $output['quantity-6'] = (int)$data['quantity_a_6'];
                 $output['total-uop-6'] = (int)$data['total_uop_a_6'];
                 $output['tag-6'] = 2;
             }
             else {

                 $output['category-6'] = $data['category_6'];
                 $output['quantity-6'] = (int)$data['quantity_6'];
                 $output['total-uop-6'] = (int)$data['total_uop_6'];
                 $output['tag-6'] = 1;
             }
             if(empty($data['quantity_7']))
             {
                 $output['category-7'] = $data['category_7'];
                 $output['quantity-7'] = (int)$data['quantity_a_7'];
                 $output['total-uop-7'] = (int)$data['total_uop_a_7'];
                 $output['tag-7'] = 2;
             }
             else {

                 $output['category-7'] = $data['category_7'];
                 $output['quantity-7'] = (int)$data['quantity_7'];
                 $output['total-uop-7'] = (int)$data['total_uop_7'];
                 $output['tag-7'] = 1;
             }
             if(empty($data['quantity_8']))
             {
                 $output['category-8'] = $data['category_8'];
                 $output['quantity-8'] = (int)$data['quantity_a_8'];
                 $output['total-uop-8'] = (int)$data['total_uop_a_8'];
                 $output['tag-8'] = 2;
             }
             else {

                 $output['category-8'] = $data['category_8'];
                 $output['quantity-8'] = (int)$data['quantity_8'];
                 $output['total-uop-8'] = (int)$data['total_uop_8'];
                 $output['tag-8'] = 1;
             }
             if(empty($data['quantity_9']))
             {
                 $output['category-9'] = $data['category_9'];
                 $output['quantity-9'] = (int)$data['quantity_a_9'];
                 $output['total-uop-9'] = (int)$data['total_uop_a_9'];
                 $output['tag-9'] = 2;
             }
             else {

                 $output['category-9'] = $data['category_9'];
                 $output['quantity-9'] = (int)$data['quantity_9'];
                 $output['total-uop-9'] = (int)$data['total_uop_9'];
                 $output['tag-9'] = 1;
             }
             if(empty($data['quantity_10']))
             {
                 $output['category-10'] = $data['category_10'];
                 $output['quantity-10'] = (int)$data['quantity_a_10'];
                 $output['total-uop-10'] = (int)$data['total_uop_a_10'];
                 $output['tag-10'] = 2;
             }
             else {

                 $output['category-10'] = $data['category_10'];
                 $output['quantity-10'] = (int)$data['quantity_10'];
                 $output['total-uop-10'] = (int)$data['total_uop_10'];
                 $output['tag-10'] = 1;
             }
             if(empty($data['quantity_11']))
             {
                 $output['category-11'] = $data['category_11'];
                 $output['quantity-11'] = (int)$data['quantity_a_11'];
                 $output['total-uop-11'] = (int)$data['total_uop_a_11'];
                 $output['tag-11'] = 2;
             }
             else {

                 $output['category-11'] = $data['category_11'];
                 $output['quantity-11'] = (int)$data['quantity_11'];
                 $output['total-uop-11'] = (int)$data['total_uop_11'];
                 $output['tag-11'] = 1;
             }
             if(empty($data['quantity_12']))
             {
                 $output['category-12'] = $data['category_12'];
                 $output['quantity-12'] = (int)$data['quantity_a_12'];
                 $output['total-uop-12'] = (int)$data['total_uop_a_12'];
                 $output['tag-12'] = 2;
             }
             else {
                 $output['category-12'] = $data['category_12'];
                 $output['quantity-12'] = (int)$data['quantity_12'];
                 $output['total-uop-12'] = (int)$data['total_uop_12'];
                 $output['tag-12'] = 1;
             }
             if(empty($data['quantity_13']))
             {
                 $output['category-13'] = $data['category_13'];
                 $output['quantity-13'] = (int)$data['quantity_a_13'];
                 $output['total-uop-13'] = (int)$data['total_uop_a_13'];
                 $output['tag-13'] = 2;
             }
             else {
                 $output['category-13'] = $data['category_13'];
                 $output['quantity-13'] = (int)$data['quantity_13'];
                 $output['total-uop-13'] = (int)$data['total_uop_13'];
                 $output['tag-13'] = 1;
             }
             if(empty($data['quantity_14']))
             {
                 $output['category-14'] = $data['category_14'];
                 $output['quantity-14'] = (int)$data['quantity_a_14'];
                 $output['total-uop-14'] = (int)$data['total_uop_a_14'];
                 $output['tag-14'] = 2;
             }
             else {
                 $output['category-14'] = $data['category_14'];
                 $output['quantity-14'] = (int)$data['quantity_14'];
                 $output['total-uop-14'] = (int)$data['total_uop_14'];
                 $output['tag-14'] = 1;
             }
             if(empty($data['quantity_15']))
             {
                 $output['category-15'] = $data['category_15'];
                 $output['quantity-15'] = (int)$data['quantity_a_15'];
                 $output['total-uop-15'] = (int)$data['total_uop_a_15'];
                 $output['tag-15'] = 2;
             }
             else {
                 $output['category-15'] = $data['category_15'];
                 $output['quantity-15'] = (int)$data['quantity_15'];
                 $output['total-uop-15'] = (int)$data['total_uop_15'];
                 $output['tag-15'] = 1;
             }
             if(empty($data['quantity_16']))
             {
                 $output['category-16'] = $data['category_16'];
                 $output['quantity-16'] = (int)$data['quantity_a_16'];
                 $output['total-uop-16'] = (int)$data['total_uop_a_16'];
                 $output['tag-16'] = 2;
             }
             else {
                 $output['category-16'] = $data['category_16'];
                 $output['quantity-16'] = (int)$data['quantity_16'];
                 $output['total-uop-16'] = (int)$data['total_uop_16'];
                 $output['tag-16'] = 1;
             }
             if(empty($data['quantity_17']))
             {
                 $output['category-17'] = $data['category_17'];
                 $output['quantity-17'] = (int)$data['quantity_a_17'];
                 $output['total-uop-17'] = (int)$data['total_uop_a_17'];
                 $output['tag-17'] = 2;
             }
             else {
                 $output['category-17'] = $data['category_17'];
                 $output['quantity-17'] = (int)$data['quantity_17'];
                 $output['total-uop-17'] = (int)$data['total_uop_17'];
                 $output['tag-17'] = 1;
             }
             if(empty($data['quantity_18']))
             {
                 $output['category-18'] = $data['category_18'];
                 $output['quantity-18'] = (int)$data['quantity_a_18'];
                 $output['total-uop-18'] = (int)$data['total_uop_a_18'];
                 $output['tag-18'] = 2;
             }
             else {
                 $output['category-18'] = $data['category_18'];
                 $output['quantity-18'] = (int)$data['quantity_18'];
                 $output['total-uop-18'] = (int)$data['total_uop_18'];
                 $output['tag-18'] = 1;
             }
             for ($i=1; $i < 13; $i++) {
                 $output['accident-'.$i] = $data['accident_'.$i];
                 $output['quantity-buy-'.$i] = (int)$data['quantity_buy_'.$i];
                 $output['amount-'.$i] = (double)$data['amount_to_pay_'.$i];
                 $output['comment-'.$i] = $data['comment_'.$i];
             }
             // insert data to accident table
                 for ($i=1; $i < 13; $i++) {
                     $result = DB::table('accident_master')->where('accident_type','=', $output['accident-'.$i])->select('id')->get();
                     $id = $result[0]->id;
                     DB::table('accident')->insert(
                       ['location' => $location, 'date' => $newdate, 'accident' => $id, '#of_quantity_tobuy' => $output['quantity-buy-'.$i],'amount' => $output['amount-'.$i],'comment' => $output['comment-'.$i] , 'created_at' => new DateTime]
                     );
                 }
             // insert data to daily progress table
             for ($i=1; $i < 6; $i++) {
                 $result = DB::table('accident_master')->where('accident_type','=', $output['accident-'.$i])->select('id')->get();
                 $id = $result[0]->id;
                 DB::table('accident')->insert(
                   ['location' => $location, 'date' => $newdate, 'accident' => $id, '#of_quantity_tobuy' => $output['quantity-buy-'.$i],'amount' => $output['amount-'.$i],'comment' => $output['comment-'.$i] , 'created_at' => new DateTime]
                 );
             }
             // insert end time to endtime table
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
    }
}
