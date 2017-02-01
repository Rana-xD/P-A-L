<?php

namespace App\Http\Controllers;

use DateTime;
use date;
use Illuminate\Http\Request;
use DB;

class System_Budget_Manager extends Controller
{
  public function budgetManager(Request $request)
  {
    $output['month'] = (int)$request->month_a;
    $output['year'] = (int)$request->year_a;
    $month = $output['month'];
    $year = $output['year'];
    $exist = DB::table('location_forecast')->where([
      ['month','=', $output['month']],
      ['year','=',$output['year']]
      ])
      ->get();
    if(empty($exist[0]))
    {
      DB::beginTransaction();
      try{
      //

      $output['location_west_1'] = $request->location_west_1;
      $output['forecast_west_revenue_1'] = $request->forecast_west_revenue_1;
      $output['forecast_west_cost_1'] = $request->forecast_west_cost_1;
      $output['forecast_west_profit_1'] = (int)$request->forecast_west_profit_1;
      $output['forecast_west_profitRate_1'] = $request->forecast_west_profitRate_1;
      $output['final_west_revenue_1'] = $request->final_west_revenue_1;
      $output['final_west_cost_1'] = $request->final_west_cost_1;
      $output['final_west_profit_1'] = (int)$request->final_west_profit_1;
      $output['final_west_profitRate_1'] = $request->final_west_profitRate_1;

      //
      $output['location_west_2'] = $request->location_west_2;
      $output['forecast_west_revenue_2'] = $request->forecast_west_revenue_2;
      $output['forecast_west_cost_2'] = $request->forecast_west_cost_2;
      $output['forecast_west_profit_2'] = (int)$request->forecast_west_profit_2;
      $output['forecast_west_profitRate_2'] = $request->forecast_west_profitRate_2;
      $output['final_west_revenue_2'] = $request->final_west_revenue_2;
      $output['final_west_cost_2'] = $request->final_west_cost_2;
      $output['final_west_profit_2'] = (int)$request->final_west_profit_2;
      $output['final_west_profitRate_2'] = $request->final_west_profitRate_2;

      //
      $output['location_central_1'] = $request->location_central_1;
      $output['forecast_central_revenue_1'] = $request->forecast_central_revenue_1;
      $output['forecast_central_cost_1'] = $request->forecast_central_cost_1;
      $output['forecast_central_profit_1'] = (int)$request->forecast_central_profit_1;
      $output['forecast_central_profitRate_1'] = $request->forecast_central_profitRate_1;
      $output['final_central_revenue_1'] = $request->final_central_revenue_1;
      $output['final_central_cost_1'] = $request->final_central_cost_1;
      $output['final_central_profit_1'] = (int)$request->final_central_profit_1;
      $output['final_central_profitRate_1'] = $request->final_central_profitRate_1;

      //
      $output['location_central_2'] = $request->location_central_2;
      $output['forecast_central_revenue_2'] = $request->forecast_central_revenue_2;
      $output['forecast_central_cost_2'] = $request->forecast_central_cost_2;
      $output['forecast_central_profit_2'] = (int)$request->forecast_central_profit_2;
      $output['forecast_central_profitRate_2'] = $request->forecast_central_profitRate_2;
      $output['final_central_revenue_2'] = $request->final_central_revenue_2;
      $output['final_central_cost_2'] = $request->final_central_cost_2;
      $output['final_central_profit_2'] = (int)$request->final_central_profit_2;
      $output['final_central_profitRate_2'] = $request->final_central_profitRate_2;

      //
      $output['location_east_1'] = $request->location_east_1;
      $output['forecast_east_revenue_1'] = $request->forecast_east_revenue_1;
      $output['forecast_east_cost_1'] = $request->forecast_east_cost_1;
      $output['forecast_east_profit_1'] = (int)$request->forecast_east_profit_1;
      $output['forecast_east_profitRate_1'] = $request->forecast_east_profitRate_1;
      $output['final_east_revenue_1'] = $request->final_east_revenue_1;
      $output['final_east_cost_1'] = $request->final_east_cost_1;
      $output['final_east_profit_1'] = (int)$request->final_east_profit_1;
      $output['final_east_profitRate_1'] = $request->final_east_profitRate_1;

      //
      $output['location_east_2'] = $request->location_east_2;
      $output['forecast_east_revenue_2'] = $request->forecast_east_revenue_2;
      $output['forecast_east_cost_2'] = $request->forecast_east_cost_2;
      $output['forecast_east_profit_2'] = (int)$request->forecast_east_profit_2;
      $output['forecast_east_profitRate_2'] = $request->forecast_east_profitRate_2;
      $output['final_east_revenue_2'] = $request->final_east_revenue_2;
      $output['final_east_cost_2'] = $request->final_east_cost_2;
      $output['final_east_profit_2'] = (int)$request->final_east_profit_2;
      $output['final_east_profitRate_2'] = $request->final_east_profitRate_2;

      //
      $output['forecast_west_sub_sale'] = $request->forecast_west_sub_sale;
      $output['forecast_west_sub_cost'] = $request->forecast_west_sub_cost;
      $output['forecast_west_sub_expense'] = $request->forecast_west_sub_expense;
      $output['forecast_west_sub_profit'] = $request->forecast_west_sub_profit;
      $output['forecast_west_sub_profit_rate'] = $request->forecast_west_sub_profit_rate;

      //
      $output['forecast_central_sub_sale'] = $request->forecast_central_sub_sale;
      $output['forecast_central_sub_cost'] = $request->forecast_central_sub_cost;
      $output['forecast_central_sub_expense'] = $request->forecast_central_sub_expense;
      $output['forecast_central_sub_profit'] = $request->forecast_central_sub_profit;
      $output['forecast_central_sub_profit_rate'] = $request->forecast_central_sub_profit_rate;

      //
      $output['forecast_east_sub_sale'] = $request->forecast_east_sub_sale;
      $output['forecast_east_sub_cost'] = $request->forecast_east_sub_cost;
      $output['forecast_east_sub_expense'] = $request->forecast_east_sub_expense;
      $output['forecast_east_sub_profit'] = $request->forecast_east_sub_profit;
      $output['forecast_east_sub_profit_rate'] = $request->forecast_east_sub_profit_rate;

      //insert into location_forecast table
      for ($i=1; $i < 3; $i++) {
        $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_west_'.$i])->get();
        $id = $location[0]->location_id;
        DB::table('location_forecast')->insert(
        ['division' => 1,'area' => 1, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['forecast_west_revenue_'.$i], 'cost' => $output['forecast_west_cost_'.$i], 'profit' => $output['forecast_west_profit_'.$i], 'profit_rate' => $output['forecast_west_profitRate_'.$i], 'created_at' => new DateTime]
        );
      }

      for ($i=1; $i < 3; $i++) {
        $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_central_'.$i])->get();
        $id = $location[0]->location_id;
        DB::table('location_forecast')->insert(
        ['division' => 1,'area' => 2, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['forecast_central_revenue_'.$i], 'cost' => $output['forecast_central_cost_'.$i], 'profit' => $output['forecast_central_profit_'.$i], 'profit_rate' => $output['forecast_central_profitRate_'.$i], 'created_at' => new DateTime]
        );
      }

      for ($i=1; $i < 3; $i++) {
        $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_east_'.$i])->get();
        $id = $location[0]->location_id;
        DB::table('location_forecast')->insert(
        ['division' => 1,'area' => 3, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['forecast_east_revenue_'.$i], 'cost' => $output['forecast_east_cost_'.$i], 'profit' => $output['forecast_east_profit_'.$i], 'profit_rate' => $output['forecast_east_profitRate_'.$i], 'created_at' => new DateTime]
        );
      }

      // insert data into final result
      $final_result_exist = DB::table('final_result')->select('headoffice_expense')
      ->where([
        ['month','=', $output['month']],
        ['year','=',$output['year']]
        ])
        ->get();

      if(empty($final_result_exist[0]))
      {
        for ($i=1; $i < 3; $i++) {
          $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_west_'.$i])->get();
          $id = $location[0]->location_id;
          DB::table('final_result')->insert(
          ['division' => 1,'area' => 1, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['final_west_revenue_'.$i], 'cost' => $output['final_west_cost_'.$i], 'profit' => $output['final_west_profit_'.$i], 'profit_rate' => $output['final_west_profitRate_'.$i], 'created_at' => new DateTime]
          );
        }
        for ($i=1; $i < 3; $i++) {
          $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_central_'.$i])->get();
          $id = $location[0]->location_id;
          DB::table('final_result')->insert(
          ['division' => 1,'area' => 2, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['final_central_revenue_'.$i], 'cost' => $output['final_central_cost_'.$i], 'profit' => $output['final_central_profit_'.$i], 'profit_rate' => $output['final_central_profitRate_'.$i], 'created_at' => new DateTime]
          );
        }
        for ($i=1; $i < 3; $i++) {
          $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_east_'.$i])->get();
          $id = $location[0]->location_id;
          DB::table('final_result')->insert(
          ['division' => 1,'area' => 3, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['final_east_revenue_'.$i], 'cost' => $output['final_east_cost_'.$i], 'profit' => $output['final_east_profit_'.$i], 'profit_rate' => $output['final_east_profitRate_'.$i], 'created_at' => new DateTime]
          );
        }
      }
      else {
        for ($i=1; $i < 3; $i++) {
          $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_west_'.$i])->get();
          $id = $location[0]->location_id;
          DB::table('final_result')->where([
            ['year',$year],
            ['month',$month],
            ['location',$id],
            ['area',1]
          ])
          ->update([ 'revenue' => $output['final_west_revenue_'.$i], 'cost' => $output['final_west_cost_'.$i], 'profit' => $output['final_west_profit_'.$i], 'profit_rate' => $output['final_west_profitRate_'.$i] ]);
        }
        for ($i=1; $i < 3; $i++) {
          $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_central_'.$i])->get();
          $id = $location[0]->location_id;
          DB::table('final_result')->where([
            ['year',$year],
            ['month',$month],
            ['location',$id],
            ['area',2]
          ])
          ->update([ 'revenue' => $output['final_central_revenue_'.$i], 'cost' => $output['final_central_cost_'.$i], 'profit' => $output['final_central_profit_'.$i], 'profit_rate' => $output['final_central_profitRate_'.$i] ]);
        }
        for ($i=1; $i < 3; $i++) {
          $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_east_'.$i])->get();
          $id = $location[0]->location_id;
          DB::table('final_result')->where([
            ['year',$year],
            ['month',$month],
            ['location',$id],
            ['area',3]
          ])
          ->update([ 'revenue' => $output['final_east_revenue_'.$i], 'cost' => $output['final_east_cost_'.$i], 'profit' => $output['final_east_profit_'.$i], 'profit_rate' => $output['final_east_profitRate_'.$i] ]);
        }
      }
      DB::table('sub_forecast')
        ->insert(
          ['division' => 1,'area' => 1,'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['forecast_west_sub_sale'], 'cost' => $output['forecast_west_sub_cost'], 'headoffice_expense' => $output['forecast_west_sub_expense'],'profit' => $output['forecast_west_sub_profit'], 'profit_rate' => $output['forecast_west_sub_profit_rate'], 'created_at' => new DateTime]
        );
      DB::table('sub_forecast')
        ->insert(
            ['division' => 1,'area' => 2,'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['forecast_central_sub_sale'], 'cost' => $output['forecast_central_sub_cost'], 'headoffice_expense' => $output['forecast_central_sub_expense'],'profit' => $output['forecast_central_sub_profit'], 'profit_rate' => $output['forecast_central_sub_profit_rate'], 'created_at' => new DateTime]
        );
      DB::table('sub_forecast')
        ->insert(
            ['division' => 1,'area' => 3,'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['forecast_central_sub_sale'], 'cost' => $output['forecast_central_sub_cost'], 'headoffice_expense' => $output['forecast_central_sub_expense'],'profit' => $output['forecast_central_sub_profit'], 'profit_rate' => $output['forecast_central_sub_profit_rate'], 'created_at' => new DateTime]
        );
      DB::commit();

  }
    catch(\Exception $e)
    {
      DB::rollback();
      return $error = $e->getMessage();

    }
    //return to veiw
    $area_west_budget = DB::table('company_budget')
                        ->join('location_master','company_budget.location','=','location_master.location_id')
                        ->select('location_master.location_name','company_budget.revenue','company_budget.cost','company_budget.profit','company_budget.profit_rate','company_budget.setting_rate','company_budget.headoffice_expense')
                        ->where([
                          ['year','=', $year],
                          ['month','=', $month],
                          ['area','=', 1]
                          ])->get();
    $area_central_budget = DB::table('company_budget')
                        ->join('location_master','company_budget.location','=','location_master.location_id')
                        ->select('location_master.location_name','company_budget.revenue','company_budget.cost','company_budget.profit','company_budget.profit_rate','company_budget.setting_rate','company_budget.headoffice_expense')
                        ->where([
                                  ['year','=', $year],
                                  ['month','=', $month],
                                  ['area','=', 2]
                                ])
                        ->get();
    $area_east_budget = DB::table('company_budget')
                         ->join('location_master','company_budget.location','=','location_master.location_id')
                         ->select('location_master.location_name','company_budget.revenue','company_budget.cost','company_budget.profit','company_budget.profit_rate','company_budget.setting_rate','company_budget.headoffice_expense')
                         ->where([
                                    ['year','=', $year],
                                    ['month','=', $month],
                                    ['area','=', 3]
                                  ])
                          ->get();
    //
    $location_forecast_west = DB::table('location_forecast')
                          ->join('location_master','location_forecast.location','=','location_master.location_id')
                          ->select('location_master.location_name','location_forecast.revenue','location_forecast.cost','location_forecast.profit','location_forecast.profit_rate')
                          ->where([
                                      ['year','=', $year],
                                      ['month','=', $month],
                                      ['area','=', 1]
                                  ])
                          ->get();
    $location_forecast_central = DB::table('location_forecast')
                          ->join('location_master','location_forecast.location','=','location_master.location_id')
                          ->select('location_master.location_name','location_forecast.revenue','location_forecast.cost','location_forecast.profit','location_forecast.profit_rate')
                          ->where([
                                       ['year','=', $year],
                                       ['month','=', $month],
                                       ['area','=', 2]
                                  ])
                          ->get();
    $location_forecast_east = DB::table('location_forecast')
                          ->join('location_master','location_forecast.location','=','location_master.location_id')
                          ->select('location_master.location_name','location_forecast.revenue','location_forecast.cost','location_forecast.profit','location_forecast.profit_rate')
                          ->where([
                                        ['year','=', $year],
                                        ['month','=', $month],
                                        ['area','=', 3]
                                  ])
                          ->get();

     //
    $location_final_west = DB::table('final_result')
                         ->join('location_master','final_result.location','=','location_master.location_id')
                         ->select('location_master.location_name','final_result.revenue','final_result.cost','final_result.profit','final_result.profit_rate','final_result.headoffice_expense')
                         ->where([
                                          ['year','=', $year],
                                          ['month','=', $month],
                                          ['area','=', 1]
                                 ])
                          ->get();
    $location_final_central = DB::table('final_result')
                         ->join('location_master','final_result.location','=','location_master.location_id')
                         ->select('location_master.location_name','final_result.revenue','final_result.cost','final_result.profit','final_result.profit_rate','final_result.headoffice_expense')
                         ->where([
                                           ['year','=', $year],
                                           ['month','=', $month],
                                           ['area','=', 2]
                                ])
                         ->get();
    $location_final_east = DB::table('final_result')
                         ->join('location_master','final_result.location','=','location_master.location_id')
                         ->select('location_master.location_name','final_result.revenue','final_result.cost','final_result.profit','final_result.profit_rate','final_result.headoffice_expense')
                         ->where([
                                             ['year','=', $year],
                                             ['month','=', $month],
                                             ['area','=', 3]
                                ])
                         ->get();
      //
    $area_west = DB::table('location_master')
                        ->select('location_name')
                        ->where('area_id','=',1)
                        ->get()
                        ->all();
    $area_central = DB::table('location_master')
                        ->select('location_name')
                        ->where('area_id','=',2)
                        ->get()
                        ->all();
    $area_east = DB::table('location_master')
                        ->select('location_name')
                        ->where('area_id','=',3)
                        ->get()
                        ->all();
     //gross_total
     $gross = DB::table('gross_total')->select('revenue','cost','headoffice_expense','profit','profit_rate')
                        ->where([
                            ['month',$month],
                            ['year',$year]
                          ])
                        ->get();
                $l = 0;
                $j = 0;
                $k = 0;
                $insert = 1;
                $update = 0;
                if(session_status()===PHP_SESSION_NONE){
                   session_start();
                   if($_SESSION['role']=='admin'){
                     return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east'));
                            }
                    else {
                      return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east','gross'));
                          }
                    }
                    elseif (session_status()===PHP_SESSION_ACTIVE)
                    {
                      if($_SESSION['role']=='admin'){
                        return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east'));
                     }
                     else {

                       return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east','gross'));
                      }
                  }
    }
    else {
      //
      DB::beginTransaction();
      try{
      $output['location_west_1'] = $request->location_west_1;
      $output['forecast_west_revenue_1'] = $request->forecast_west_revenue_1;
      $output['forecast_west_cost_1'] = $request->forecast_west_cost_1;
      $output['forecast_west_profit_1'] = (int)$request->forecast_west_profit_1;
      $output['forecast_west_profitRate_1'] = $request->forecast_west_profitRate_1;
      $output['final_west_revenue_1'] = $request->final_west_revenue_1;
      $output['final_west_cost_1'] = $request->final_west_cost_1;
      $output['final_west_profit_1'] = (int)$request->final_west_profit_1;
      $output['final_west_profitRate_1'] = $request->final_west_profitRate_1;

      //
      $output['location_west_2'] = $request->location_west_2;
      $output['forecast_west_revenue_2'] = $request->forecast_west_revenue_2;
      $output['forecast_west_cost_2'] = $request->forecast_west_cost_2;
      $output['forecast_west_profit_2'] = (int)$request->forecast_west_profit_2;
      $output['forecast_west_profitRate_2'] = $request->forecast_west_profitRate_2;
      $output['final_west_revenue_2'] = $request->final_west_revenue_2;
      $output['final_west_cost_2'] = $request->final_west_cost_2;
      $output['final_west_profit_2'] = (int)$request->final_west_profit_2;
      $output['final_west_profitRate_2'] = $request->final_west_profitRate_2;

      //
      $output['location_central_1'] = $request->location_central_1;
      $output['forecast_central_revenue_1'] = $request->forecast_central_revenue_1;
      $output['forecast_central_cost_1'] = $request->forecast_central_cost_1;
      $output['forecast_central_profit_1'] = (int)$request->forecast_central_profit_1;
      $output['forecast_central_profitRate_1'] = $request->forecast_central_profitRate_1;
      $output['final_central_revenue_1'] = $request->final_central_revenue_1;
      $output['final_central_cost_1'] = $request->final_central_cost_1;
      $output['final_central_profit_1'] = (int)$request->final_central_profit_1;
      $output['final_central_profitRate_1'] = $request->final_central_profitRate_1;

      //
      $output['location_central_2'] = $request->location_central_2;
      $output['forecast_central_revenue_2'] = $request->forecast_central_revenue_2;
      $output['forecast_central_cost_2'] = $request->forecast_central_cost_2;
      $output['forecast_central_profit_2'] = (int)$request->forecast_central_profit_2;
      $output['forecast_central_profitRate_2'] = $request->forecast_central_profitRate_2;
      $output['final_central_revenue_2'] = $request->final_central_revenue_2;
      $output['final_central_cost_2'] = $request->final_central_cost_2;
      $output['final_central_profit_2'] = (int)$request->final_central_profit_2;
      $output['final_central_profitRate_2'] = $request->final_central_profitRate_2;

      //
      $output['location_east_1'] = $request->location_east_1;
      $output['forecast_east_revenue_1'] = $request->forecast_east_revenue_1;
      $output['forecast_east_cost_1'] = $request->forecast_east_cost_1;
      $output['forecast_east_profit_1'] = (int)$request->forecast_east_profit_1;
      $output['forecast_east_profitRate_1'] = $request->forecast_east_profitRate_1;
      $output['final_east_revenue_1'] = $request->final_east_revenue_1;
      $output['final_east_cost_1'] = $request->final_east_cost_1;
      $output['final_east_profit_1'] = (int)$request->final_east_profit_1;
      $output['final_east_profitRate_1'] = $request->final_east_profitRate_1;

      //
      $output['forecast_west_sub_sale'] = $request->forecast_west_sub_sale;
      $output['forecast_west_sub_cost'] = $request->forecast_west_sub_cost;
      $output['forecast_west_sub_expense'] = $request->forecast_west_sub_expense;
      $output['forecast_west_sub_profit'] = $request->forecast_west_sub_profit;
      $output['forecast_west_sub_profit_rate'] = $request->forecast_west_sub_profit_rate;

      //
      $output['forecast_central_sub_sale'] = $request->forecast_central_sub_sale;
      $output['forecast_central_sub_cost'] = $request->forecast_central_sub_cost;
      $output['forecast_central_sub_expense'] = $request->forecast_central_sub_expense;
      $output['forecast_central_sub_profit'] = $request->forecast_central_sub_profit;
      $output['forecast_central_sub_profit_rate'] = $request->forecast_central_sub_profit_rate;

      //
      $output['forecast_east_sub_sale'] = $request->forecast_east_sub_sale;
      $output['forecast_east_sub_cost'] = $request->forecast_east_sub_cost;
      $output['forecast_east_sub_expense'] = $request->forecast_east_sub_expense;
      $output['forecast_east_sub_profit'] = $request->forecast_east_sub_profit;
      $output['forecast_east_sub_profit_rate'] = $request->forecast_east_sub_profit_rate;

      //
      $output['location_east_2'] = $request->location_east_2;
      $output['forecast_east_revenue_2'] = $request->forecast_east_revenue_2;
      $output['forecast_east_cost_2'] = $request->forecast_east_cost_2;
      $output['forecast_east_profit_2'] = (int)$request->forecast_east_profit_2;
      $output['forecast_east_profitRate_2'] = $request->forecast_east_profitRate_2;
      $output['final_east_revenue_2'] = $request->final_east_revenue_2;
      $output['final_east_cost_2'] = $request->final_east_cost_2;
      $output['final_east_profit_2'] = (int)$request->final_east_profit_2;
      $output['final_east_profitRate_2'] = $request->final_east_profitRate_2;

      //
      for ($i=1; $i < 3; $i++) {
          $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_west_'.$i])->get();
          $id = $location[0]->location_id;
          DB::table('location_forecast')
          ->where([
            ['area',1],
            ['location',$id],
            ['month',$output['month']],
            ['year',$output['year']]
          ])->update(
          ['division' => 1, 'revenue' => $output['forecast_west_revenue_'.$i], 'cost' => $output['forecast_west_cost_'.$i], 'profit' => $output['forecast_west_profit_'.$i], 'profit_rate' => $output['forecast_west_profitRate_'.$i], 'updated_at' => new DateTime]);
      }
      for ($i=1; $i < 3; $i++) {
          $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_central_'.$i])->get();
          $id = $location[0]->location_id;
          DB::table('location_forecast')
          ->where([
            ['area',2],
            ['location',$id],
            ['month',$output['month']],
            ['year',$output['year']]
          ])->update(
          ['division' => 1, 'revenue' => $output['forecast_central_revenue_'.$i], 'cost' => $output['forecast_central_cost_'.$i], 'profit' => $output['forecast_central_profit_'.$i], 'profit_rate' => $output['forecast_central_profitRate_'.$i], 'updated_at' => new DateTime]);
      }
      for ($i=1; $i < 3; $i++) {
          $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_east_'.$i])->get();
          $id = $location[0]->location_id;
          DB::table('location_forecast')
          ->where([
            ['area',3],
            ['location',$id],
            ['month',$output['month']],
            ['year',$output['year']]
          ])->update(
          ['division' => 1, 'revenue' => $output['forecast_east_revenue_'.$i], 'cost' => $output['forecast_east_cost_'.$i], 'profit' => $output['forecast_east_profit_'.$i], 'profit_rate' => $output['forecast_east_profitRate_'.$i], 'updated_at' => new DateTime]);
      }

      // update data into final result
      for ($i=1; $i < 3; $i++) {
        $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_west_'.$i])->get();
        $id = $location[0]->location_id;
        DB::table('final_result')->where([
          ['year',$year],
          ['month',$month],
          ['location',$id],
          ['area',1]
        ])
        ->update([ 'revenue' => $output['final_west_revenue_'.$i], 'cost' => $output['final_west_cost_'.$i], 'profit' => $output['final_west_profit_'.$i], 'profit_rate' => $output['final_west_profitRate_'.$i] ]);
      }
      for ($i=1; $i < 3; $i++) {
        $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_central_'.$i])->get();
        $id = $location[0]->location_id;
        DB::table('final_result')->where([
          ['year',$year],
          ['month',$month],
          ['location',$id],
          ['area',2]
        ])
        ->update([ 'revenue' => $output['final_central_revenue_'.$i], 'cost' => $output['final_central_cost_'.$i], 'profit' => $output['final_central_profit_'.$i], 'profit_rate' => $output['final_central_profitRate_'.$i] ]);
      }
      for ($i=1; $i < 3; $i++) {
        $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['location_east_'.$i])->get();
        $id = $location[0]->location_id;
        DB::table('final_result')->where([
          ['year',$year],
          ['month',$month],
          ['location',$id],
          ['area',3]
        ])
        ->update([ 'revenue' => $output['final_east_revenue_'.$i], 'cost' => $output['final_east_cost_'.$i], 'profit' => $output['final_east_profit_'.$i], 'profit_rate' => $output['final_east_profitRate_'.$i] ]);
      }
      DB::table('sub_forecast')
        ->where([
          ['month',$month],
          ['year',$year],
          ['area',1]
        ])
        ->update(
          ['division' => 1, 'revenue' => $output['forecast_west_sub_sale'], 'cost' => $output['forecast_west_sub_cost'], 'headoffice_expense' => $output['forecast_west_sub_expense'],'profit' => $output['forecast_west_sub_profit'], 'profit_rate' => $output['forecast_west_sub_profit_rate'], 'updated_at' => new DateTime]
        );
        DB::table('sub_forecast')
          ->where([
            ['month',$month],
            ['year',$year],
            ['area',2]
          ])
          ->update(
            ['division' => 1, 'revenue' => $output['forecast_central_sub_sale'], 'cost' => $output['forecast_central_sub_cost'], 'headoffice_expense' => $output['forecast_central_sub_expense'],'profit' => $output['forecast_central_sub_profit'], 'profit_rate' => $output['forecast_central_sub_profit_rate'], 'updated_at' => new DateTime]
          );
          DB::table('sub_forecast')
            ->where([
              ['month',$month],
              ['year',$year],
              ['area',3]
            ])
            ->update(
              ['division' => 1, 'revenue' => $output['forecast_east_sub_sale'], 'cost' => $output['forecast_east_sub_cost'], 'headoffice_expense' => $output['forecast_east_sub_expense'],'profit' => $output['forecast_east_sub_profit'], 'profit_rate' => $output['forecast_east_sub_profit_rate'], 'updated_at' => new DateTime]
            );


      DB::commit();
      //
      $area_west_budget = DB::table('company_budget')
                          ->join('location_master','company_budget.location','=','location_master.location_id')
                          ->select('location_master.location_name','company_budget.revenue','company_budget.cost','company_budget.profit','company_budget.profit_rate','company_budget.setting_rate','company_budget.headoffice_expense')
                          ->where([
                            ['year','=', $year],
                            ['month','=', $month],
                            ['area','=', 1]
                            ])->get();
      $area_central_budget = DB::table('company_budget')
                          ->join('location_master','company_budget.location','=','location_master.location_id')
                          ->select('location_master.location_name','company_budget.revenue','company_budget.cost','company_budget.profit','company_budget.profit_rate','company_budget.setting_rate','company_budget.headoffice_expense')
                          ->where([
                                    ['year','=', $year],
                                    ['month','=', $month],
                                    ['area','=', 2]
                                  ])
                          ->get();
      $area_east_budget = DB::table('company_budget')
                           ->join('location_master','company_budget.location','=','location_master.location_id')
                           ->select('location_master.location_name','company_budget.revenue','company_budget.cost','company_budget.profit','company_budget.profit_rate','company_budget.setting_rate','company_budget.headoffice_expense')
                           ->where([
                                      ['year','=', $year],
                                      ['month','=', $month],
                                      ['area','=', 3]
                                    ])
                            ->get();
      //
      $location_forecast_west = DB::table('location_forecast')
                            ->join('location_master','location_forecast.location','=','location_master.location_id')
                            ->select('location_master.location_name','location_forecast.revenue','location_forecast.cost','location_forecast.profit','location_forecast.profit_rate')
                            ->where([
                                        ['year','=', $year],
                                        ['month','=', $month],
                                        ['area','=', 1]
                                    ])
                            ->get();
      $location_forecast_central = DB::table('location_forecast')
                            ->join('location_master','location_forecast.location','=','location_master.location_id')
                            ->select('location_master.location_name','location_forecast.revenue','location_forecast.cost','location_forecast.profit','location_forecast.profit_rate')
                            ->where([
                                         ['year','=', $year],
                                         ['month','=', $month],
                                         ['area','=', 2]
                                    ])
                            ->get();
      $location_forecast_east = DB::table('location_forecast')
                            ->join('location_master','location_forecast.location','=','location_master.location_id')
                            ->select('location_master.location_name','location_forecast.revenue','location_forecast.cost','location_forecast.profit','location_forecast.profit_rate')
                            ->where([
                                          ['year','=', $year],
                                          ['month','=', $month],
                                          ['area','=', 3]
                                    ])
                            ->get();

       //
      $location_final_west = DB::table('final_result')
                           ->join('location_master','final_result.location','=','location_master.location_id')
                           ->select('location_master.location_name','final_result.revenue','final_result.cost','final_result.profit','final_result.profit_rate','final_result.headoffice_expense')
                           ->where([
                                            ['year','=', $year],
                                            ['month','=', $month],
                                            ['area','=', 1]
                                   ])
                            ->get();
      $location_final_central = DB::table('final_result')
                           ->join('location_master','final_result.location','=','location_master.location_id')
                           ->select('location_master.location_name','final_result.revenue','final_result.cost','final_result.profit','final_result.profit_rate','final_result.headoffice_expense')
                           ->where([
                                             ['year','=', $year],
                                             ['month','=', $month],
                                             ['area','=', 2]
                                  ])
                           ->get();
      $location_final_east = DB::table('final_result')
                           ->join('location_master','final_result.location','=','location_master.location_id')
                           ->select('location_master.location_name','final_result.revenue','final_result.cost','final_result.profit','final_result.profit_rate','final_result.headoffice_expense')
                           ->where([
                                               ['year','=', $year],
                                               ['month','=', $month],
                                               ['area','=', 3]
                                  ])
                           ->get();
        //
      $area_west = DB::table('location_master')
                          ->select('location_name')
                          ->where('area_id','=',1)
                          ->get()
                          ->all();
      $area_central = DB::table('location_master')
                          ->select('location_name')
                          ->where('area_id','=',2)
                          ->get()
                          ->all();
      $area_east = DB::table('location_master')
                          ->select('location_name')
                          ->where('area_id','=',3)
                          ->get()
                          ->all();
      //gross_total
      $gross = DB::table('gross_total')->select('revenue','cost','headoffice_expense','profit','profit_rate')
                          ->where([
                              ['month',$month],
                              ['year',$year]
                            ])
                          ->get();
                  $l = 0;
                  $j = 0;
                  $k = 0;
                  $insert = 0;
                  $update = 1;
                  if(session_status()===PHP_SESSION_NONE){
                     session_start();
                     if($_SESSION['role']=='admin'){
                       return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east'));
                              }
                      else {
                        return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east','gross'));
                            }
                      }
                      elseif (session_status()===PHP_SESSION_ACTIVE)
                      {
                        if($_SESSION['role']=='admin'){
                          return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east'));
                       }
                       else {

                         return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east','gross'));
                        }
                    }
    }
    catch(\Exception $e)
  {
    DB::rollback();
    return $error = $e->getMessage();

  }
    }
  }
}
