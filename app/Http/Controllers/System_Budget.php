<?php

namespace App\Http\Controllers;

use DateTime;
use date;
use Illuminate\Http\Request;
use DB;
class System_Budget extends Controller
{
  public function budget()
    {

      DB::beginTransaction();
      try{
      $month = (int)date("m");
      $year = (int)date("Y");
      $insert = 0;
      $update = 0;
      $area_west_budget = DB::table('company_budget')
                          ->join('location_master','company_budget.location','=','location_master.location_id')
                          ->select('location_master.location_name','company_budget.revenue','company_budget.cost','company_budget.profit','company_budget.profit_rate','company_budget.setting_rate','company_budget.headoffice_expense')
                          ->where([
                            ['year','=', $year],
                            ['month','=', $month],
                            ['area','=', 1]
                          ])
                          ->get();
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
      $sub_budget_west = DB::table('sub_budget')
                        ->select('revenue','cost','headoffice_expense','profit','profit_rate')
                        ->where([
                          ['month','=',$month],
                          ['year','=',$year],
                          ['area','=',1]
                        ])
                        ->get();
      $sub_budget_central = DB::table('sub_budget')
                        ->select('revenue','cost','headoffice_expense','profit','profit_rate')
                        ->where([
                          ['month','=',$month],
                          ['year','=',$year],
                          ['area','=',2]
                        ])
                        ->get();
      $sub_budget_east = DB::table('sub_budget')
                        ->select('revenue','cost','headoffice_expense','profit','profit_rate')
                        ->where([
                           ['month','=',$month],
                           ['year','=',$year],
                           ['area','=',3]
                         ])
                         ->get();
      //
      $sub_forecast_west = DB::table('sub_forecast')
                        ->select('revenue','cost','headoffice_expense','profit','profit_rate')
                        ->where([
                           ['month','=',$month],
                           ['year','=',$year],
                           ['area','=',1]
                         ])
                         ->get();
       $sub_forecast_central = DB::table('sub_forecast')
                        ->select('revenue','cost','headoffice_expense','profit','profit_rate')
                        ->where([
                              ['month','=',$month],
                              ['year','=',$year],
                              ['area','=',2]
                            ])
                            ->get();
       $sub_forecast_east = DB::table('sub_forecast')
                        ->select('revenue','cost','headoffice_expense','profit','profit_rate')
                        ->where([
                              ['month','=',$month],
                              ['year','=',$year],
                              ['area','=',3]
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
      DB::commit();
      $l = 0;
      $j = 0;
      $k = 0;
      if(session_status()===PHP_SESSION_NONE){
         session_start();
        if($_SESSION['role']=='admin'){
          return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east','sub_forecast_west','sub_forecast_central','sub_forecast_east'));
        }
        else {
          return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east','gross','sub_budget_west','sub_budget_central','sub_budget_east'));
        }
         }
      elseif (session_status()===PHP_SESSION_ACTIVE)
      {
        if($_SESSION['role']=='admin'){
          return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east','sub_forecast_west','sub_forecast_central','sub_forecast_east'));
        }
        else {

          return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east','gross','sub_budget_west','sub_budget_central','sub_budget_east'));
        }
      }
    }
    catch(\Exception $e)
  {
    DB::rollback();
    return $error = $e->getMessage();

  }
    }
    public function budgetAdmin(Request $request)
    {
        // get month and year input
        $output['month'] = (int)$request->month_a;
        $output['year'] = (int)$request->year_a;
        $month = $output['month'];
        $year = $output['year'];
        $exist = DB::table('company_budget')->where([
          ['month','=', $output['month']],
          ['year','=',$output['year']]
          ])
          ->get();
        if(empty($exist[0]))
        {
          DB::beginTransaction();
          try{
          $output['area_west_location_1'] = $request->area_west_location_1;
          $output['area_west_revenue_1'] = (int)$request->area_west_revenue_1;
          $output['area_west_expense_1'] = (int)$request->area_west_expense_1;
          $output['area_west_cost_1'] = (int)$request->area_west_cost_1;
          $output['area_west_profit_1'] = (int)$request->area_west_profit_1;
          $output['area_west_profitRate_1'] = (double)$request->area_west_profitRate_1;
          $output['area_west_settingRate_1'] = (double)$request->area_west_settingRate_1;

          $output['area_west_location_2'] = $request->area_west_location_2;
          $output['area_west_revenue_2'] = (int)$request->area_west_revenue_2;
          $output['area_west_expense_2'] = (int)$request->area_west_expense_2;
          $output['area_west_cost_2'] = (int)$request->area_west_cost_2;
          $output['area_west_profit_2'] = (int)$request->area_west_profit_2;
          $output['area_west_profitRate_2'] = (double)$request->area_west_profitRate_2;
          $output['area_west_settingRate_2'] = (double)$request->area_west_settingRate_2;

          $output['area_central_location_1'] = $request->area_central_location_1;
          $output['area_central_revenue_1'] = (int)$request->area_central_revenue_1;
          $output['area_central_expense_1'] = (int)(int)$request->area_central_expense_1;
          $output['area_central_cost_1'] = (int)$request->area_central_cost_1;
          $output['area_central_profit_1'] = (int)$request->area_central_profit_1;
          $output['area_central_profitRate_1'] = (double)$request->area_central_profitRate_1;
          $output['area_central_settingRate_1'] = (double)$request->area_central_settingRate_1;

          $output['area_central_location_2'] = $request->area_central_location_2;
          $output['area_central_revenue_2'] = (int)$request->area_central_revenue_2;
          $output['area_central_expense_2'] = (int)$request->area_central_expense_1;
          $output['area_central_cost_2'] = $request->area_central_cost_2;
          $output['area_central_profit_2'] = (int)$request->area_central_profit_2;
          $output['area_central_profitRate_2'] = (double)$request->area_central_profitRate_2;
          $output['area_central_settingRate_2'] = (double)$request->area_central_settingRate_2;

          $output['area_east_location_1'] = $request->area_east_location_1;
          $output['area_east_revenue_1'] = (int)$request->area_east_revenue_1;
          $output['area_east_expense_1'] = (int)$request->area_east_expense_1;
          $output['area_east_cost_1'] = (int)$request->area_east_cost_1;
          $output['area_east_profit_1'] = (int)$request->area_east_profit_1;
          $output['area_east_profitRate_1'] = (double)$request->area_east_profitRate_1;
          $output['area_east_settingRate_1'] = (double)$request->area_east_settingRate_1;

          $output['area_east_location_2'] = $request->area_east_location_2;
          $output['area_east_revenue_2'] = (int)$request->area_east_revenue_2;
          $output['area_east_expense_2'] =(int) $request->area_east_expense_2;
          $output['area_east_cost_2'] = (int)$request->area_east_cost_2;
          $output['area_east_profit_2'] = (int)$request->area_east_profit_2;
          $output['area_east_profitRate_2'] = (double)$request->area_east_profitRate_2;
          $output['area_east_settingRate_2'] = (double)$request->area_east_settingRate_2;

          $output['final_west_1'] = (int)$request->area_west_expense_1;
          $output['final_west_2'] = (int)$request->area_west_expense_2;
          $output['final_central_1'] = (int)$request->area_central_expense_1;
          $output['final_central_2'] = (int)$request->area_central_expense_2;
          $output['final_east_1'] = (int)$request->area_east_expense_1;
          $output['final_east_2'] = (int)$request->area_east_expense_2;

          $output['company_west_sub_sale'] = $request->company_west_sub_sale;
          $output['company_west_sub_cost'] = $request->company_west_sub_cost;
          $output['comapny_west_sub_expense'] = $request->comapny_west_sub_expense;
          $output['company_west_sub_profit'] = $request->company_west_sub_profit;
          $output['comapny_west_sub_profit_rate'] = $request->comapny_west_sub_profit_rate;

          $output['company_central_sub_sale'] = $request->company_central_sub_sale;
          $output['company_central_sub_cost'] = $request->company_central_sub_cost;
          $output['company_central_sub_expense'] = $request->company_central_sub_expense;
          $output['company_central_sub_profit'] = $request->company_central_sub_profit;
          $output['company_central_sub_profit_rate'] = $request->company_central_sub_profit_rate;

          $output['company_east_sub_sale'] = $request->company_east_sub_sale;
          $output['company_east_sub_cost'] = $request->company_east_sub_cost;
          $output['company_east_sub_expense'] = $request->company_east_sub_expense;
          $output['company_east_sub_profit'] = $request->company_east_sub_profit;
          $output['company_east_sub_profit_rate'] = $request->company_east_sub_profit_rate;

          $output['gross_revenue'] = $request->gross_sale;
          $output['gross_cost'] = $request->gross_cost;
          $output['gross_expense'] = $request->gross_expense;
          $output['gross_profit'] = (int)$request->gross_profit;
          $output['gross_profit_rate'] = $request->gross_profit_rate;

          

          DB::table('gross_total')
              ->insert(
                ['year' => $year, 'month' => $month, 'revenue' => $output['gross_revenue'], 'cost' => $output['gross_cost'], 'headoffice_expense' => $output['gross_expense'],'profit' => $output['gross_profit'],'profit_rate' => $output['gross_profit_rate'],'created_at' => new DateTime]
              );

          $final_result = DB::table('final_result')
                        ->where([
                          ['year','=', $year],
                          ['month','=',$month]
                        ])
                        ->get();

          // insert data into final result
          if(empty($final_result[0]))
          {

            for ($i=1; $i < 3; $i++) {
              $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_west_location_'.$i])->get();
              $id = $location[0]->location_id;

              DB::table('final_result')->insert(
              ['division' => 1,'area' => 1, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'],'headoffice_expense' => $output['final_west_'.$i], 'created_at' => new DateTime]
              );

            }

            for ($i=1; $i < 3; $i++) {

              $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_central_location_'.$i])->get();
              $id = $location[0]->location_id;
              DB::table('final_result')->insert(
              ['division' => 1,'area' => 2, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'],'headoffice_expense' => $output['final_central_'.$i], 'created_at' => new DateTime]
              );

            }
            for ($i=1; $i < 3; $i++) {
              $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_east_location_'.$i])->get();
              $id = $location[0]->location_id;
              DB::table('final_result')->insert(
              ['division' => 1,'area' => 3, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'],'headoffice_expense' => $output['final_east_'.$i], 'created_at' => new DateTime]
              );
            }
          }
          else {
            for ($i=1; $i < 3; $i++) {
              $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_west_location_'.$i])->get();
              $id = $location[0]->location_id;
              DB::table('final_result')->where([
                ['year',$year],
                ['month',$month],
                ['location',$id],
                ['area', 1]
              ])
               ->update(['headoffice_expense' => $output['final_west_'.$i]]);
            }

            for ($i=1; $i < 3; $i++) {
              $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_central_location_'.$i])->get();
              $id = $location[0]->location_id;
              DB::table('final_result')->where([
                ['year',$year],
                ['month',$month],
                ['location',$id],
                ['area', 2]
              ])
               ->update(['headoffice_expense' => $output['final_central_'.$i]]);
            }

            for ($i=1; $i < 3; $i++) {
              $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_east_location_'.$i])->get();
              $id = $location[0]->location_id;
              DB::table('final_result')->where([
                ['year',$year],
                ['month',$month],
                ['location',$id],
                ['area', 3]
              ])
               ->update(['headoffice_expense' => $output['final_east_'.$i]]);
            }
          }


          for ($i=1; $i < 3; $i++) {
              $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_west_location_'.$i])->get();
              $id = $location[0]->location_id;
              DB::table('company_budget')->insert(
              ['division' => 1,'area' => 1, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['area_west_revenue_'.$i], 'cost' => $output['area_west_cost_'.$i], 'profit' => $output['area_west_profit_'.$i], 'profit_rate' => $output['area_west_profitRate_'.$i], 'setting_rate' => $output['area_west_settingRate_'.$i], 'created_at' => new DateTime,'headoffice_expense' => $output['area_west_expense_'.$i]]
              );
          }

          for ($i=1; $i < 3; $i++) {
              $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_central_location_'.$i])->get();
              $id = $location[0]->location_id;
              DB::table('company_budget')->insert(
              ['division' => 1,'area' => 2, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['area_central_revenue_'.$i], 'cost' => $output['area_central_cost_'.$i], 'profit' => $output['area_central_profit_'.$i], 'profit_rate' => $output['area_central_profitRate_'.$i], 'setting_rate' => $output['area_central_settingRate_'.$i], 'created_at' => new DateTime, 'headoffice_expense' => $output['area_central_expense_'.$i]]
              );
          }

          for ($i=1; $i < 3; $i++) {
              $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_east_location_'.$i])->get();
              $id = $location[0]->location_id;
              DB::table('company_budget')->insert(
              ['division' => 1,'area' => 3, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['area_east_revenue_'.$i], 'cost' => $output['area_east_cost_'.$i], 'profit' => $output['area_east_profit_'.$i], 'profit_rate' => $output['area_east_profitRate_'.$i], 'setting_rate' => $output['area_east_settingRate_'.$i], 'created_at' => new DateTime, 'headoffice_expense' => $output['area_east_expense_'.$i]]
              );
          }

          DB::table('sub_budget')
            ->insert(
              ['division' => 1,'area' => 1, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['company_west_sub_sale'], 'cost' => $output['company_west_sub_cost'], 'profit' => $output['company_west_sub_profit'], 'profit_rate' => $output['comapny_west_sub_profit_rate'], 'created_at' => new DateTime, 'headoffice_expense' => $output['comapny_west_sub_expense']]
            );
          DB::table('sub_budget')
            ->insert(
              ['division' => 1,'area' => 2, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['company_central_sub_sale'], 'cost' => $output['company_central_sub_cost'], 'profit' => $output['company_central_sub_profit'], 'profit_rate' => $output['company_central_sub_profit_rate'], 'created_at' => new DateTime, 'headoffice_expense' => $output['company_central_sub_expense']]
            );
          DB::table('sub_budget')
            ->insert(
              ['division' => 1,'area' => 3, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['company_east_sub_sale'], 'cost' => $output['company_east_sub_cost'], 'profit' => $output['company_east_sub_profit'], 'profit_rate' => $output['company_east_sub_profit_rate'], 'created_at' => new DateTime, 'headoffice_expense' => $output['company_east_sub_expense']]
            );
          DB::commit();
        }
        catch(\Exception $e)
      {
        DB::rollback();
        return $error = $e->getMessage();

      }
          //return to page and nofify success
          $insert = 1;
          $update = 0;
          $area_west_budget = DB::table('company_budget')
                              ->join('location_master','company_budget.location','=','location_master.location_id')
                              ->select('location_master.location_name','company_budget.revenue','company_budget.cost','company_budget.profit','company_budget.profit_rate','company_budget.setting_rate','company_budget.headoffice_expense')
                              ->where([
                                ['year','=', $output['year']],
                                ['month','=', $output['month']],
                                ['area','=', 1]
                              ])
                              ->get();
          $area_central_budget = DB::table('company_budget')
                              ->join('location_master','company_budget.location','=','location_master.location_id')
                              ->select('location_master.location_name','company_budget.revenue','company_budget.cost','company_budget.profit','company_budget.profit_rate','company_budget.setting_rate','company_budget.headoffice_expense')
                              ->where([
                                        ['year','=', $output['year']],
                                        ['month','=', $output['month']],
                                        ['area','=', 2]
                                      ])
                              ->get();
          $area_east_budget = DB::table('company_budget')
                               ->join('location_master','company_budget.location','=','location_master.location_id')
                               ->select('location_master.location_name','company_budget.revenue','company_budget.cost','company_budget.profit','company_budget.profit_rate','company_budget.setting_rate','company_budget.headoffice_expense')
                               ->where([
                                          ['year','=', $output['year']],
                                          ['month','=', $output['month']],
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
                                $l = 0;
                                $j = 0;
                                $k = 0;
                                if(session_status()===PHP_SESSION_NONE){
                                   session_start();
                                  if($_SESSION['role']=='admin'){
                                    return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east'));
                                  }
                                  else {
                                    return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east'));
                                  }
                                   }
                                elseif (session_status()===PHP_SESSION_ACTIVE)
                                {
                                  if($_SESSION['role']=='admin'){
                                    return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east'));
                                  }
                                  else {

                                    return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east'));
                                  }
                                }

        }
        else {
          DB::beginTransaction();
          try{

          $output['area_west_location_1'] = $request->area_west_location_1;
          $output['area_west_revenue_1'] = $request->area_west_revenue_1;
          $output['area_west_expense_1'] = $request->area_west_expense_1;
          $output['area_west_cost_1'] = $request->area_west_cost_1;
          $output['area_west_profit_1'] = $request->area_west_profit_1;
          $output['area_west_profitRate_1'] = $request->area_west_profitRate_1;
          $output['area_west_settingRate_1'] = $request->area_west_settingRate_1;

          $output['area_west_location_2'] = $request->area_west_location_2;
          $output['area_west_revenue_2'] = $request->area_west_revenue_2;
          $output['area_west_expense_2'] = $request->area_west_expense_2;
          $output['area_west_cost_2'] = $request->area_west_cost_2;
          $output['area_west_profit_2'] = $request->area_west_profit_2;
          $output['area_west_profitRate_2'] = $request->area_west_profitRate_2;
          $output['area_west_settingRate_2'] = $request->area_west_settingRate_2;


          $output['area_central_location_1'] = $request->area_central_location_1;
          $output['area_central_revenue_1'] = $request->area_central_revenue_1;
          $output['area_central_expense_1'] = $request->area_central_expense_1;
          $output['area_central_cost_1'] = $request->area_central_cost_1;
          $output['area_central_profit_1'] = $request->area_central_profit_1;
          $output['area_central_profitRate_1'] = $request->area_central_profitRate_1;
          $output['area_central_settingRate_1'] = $request->area_central_settingRate_1;


          $output['area_central_location_2'] = $request->area_central_location_2;
          $output['area_central_revenue_2'] = $request->area_central_revenue_2;
          $output['area_central_expense_2'] = $request->area_central_expense_1;
          $output['area_central_cost_2'] = $request->area_central_cost_2;
          $output['area_central_profit_2'] = $request->area_central_profit_2;
          $output['area_central_profitRate_2'] = $request->area_central_profitRate_2;
          $output['area_central_settingRate_2'] = $request->area_central_settingRate_2;

          $output['area_east_location_1'] = $request->area_east_location_1;
          $output['area_east_revenue_1'] = $request->area_east_revenue_1;
          $output['area_east_expense_1'] = $request->area_east_expense_1;
          $output['area_east_cost_1'] = $request->area_east_cost_1;
          $output['area_east_profit_1'] = $request->area_east_profit_1;
          $output['area_east_profitRate_1'] = $request->area_east_profitRate_1;
          $output['area_east_settingRate_1'] = $request->area_east_settingRate_1;

          $output['area_east_location_2'] = $request->area_east_location_2;
          $output['area_east_revenue_2'] = $request->area_east_revenue_2;
          $output['area_east_expense_2'] = $request->area_east_expense_2;
          $output['area_east_cost_2'] = $request->area_east_cost_2;
          $output['area_east_profit_2'] = $request->area_east_profit_2;
          $output['area_east_profitRate_2'] = $request->area_east_profitRate_2;
          $output['area_east_settingRate_2'] = $request->area_east_settingRate_2;

          $output['final_west_1'] = $request->area_west_expense_1;
          $output['final_west_2'] = $request->area_west_expense_2;
          $output['final_central_1'] = $request->area_central_expense_1;
          $output['final_central_2'] = $request->area_central_expense_2;
          $output['final_east_1'] = $request->area_east_expense_1;
          $output['final_east_2'] = $request->area_east_expense_2;

          $output['company_west_sub_sale'] = $request->company_west_sub_sale;
          $output['company_west_sub_cost'] = $request->company_west_sub_cost;
          $output['comapny_west_sub_expense'] = $request->comapny_west_sub_expense;
          $output['company_west_sub_profit'] = $request->company_west_sub_profit;
          $output['comapny_west_sub_profit_rate'] = $request->comapny_west_sub_profit_rate;

          $output['company_central_sub_sale'] = $request->company_central_sub_sale;
          $output['company_central_sub_cost'] = $request->company_central_sub_cost;
          $output['company_central_sub_expense'] = $request->company_central_sub_expense;
          $output['company_central_sub_profit'] = $request->company_central_sub_profit;
          $output['company_central_sub_profit_rate'] = $request->company_central_sub_profit_rate;

          $output['company_east_sub_sale'] = $request->company_east_sub_sale;
          $output['company_east_sub_cost'] = $request->company_east_sub_cost;
          $output['company_east_sub_expense'] = $request->company_east_sub_expense;
          $output['company_east_sub_profit'] = $request->company_east_sub_profit;
          $output['company_east_sub_profit_rate'] = $request->company_east_sub_profit_rate;

          $output['gross_revenue'] = $request->gross_sale;
          $output['gross_cost'] = $request->gross_cost;
          $output['gross_expense'] = $request->gross_expense;
          $output['gross_profit'] = (int)$request->gross_profit;
          $output['gross_profit_rate'] = $request->gross_profit_rate;

          DB::table('gross_total')->where([
            ['year',$year],
            ['month',$month]
          ])
          ->update(['revenue' => $output['gross_revenue'], 'cost' => $output['gross_cost'], 'headoffice_expense' => $output['gross_expense'],'profit' => $output['gross_profit'],'profit_rate' => $output['gross_profit_rate'],'updated_at' => new DateTime]);

          //update final result
          for ($i=1; $i < 3; $i++) {
            $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_west_location_'.$i])->get();
            $id = $location[0]->location_id;
            DB::table('final_result')->where([
              ['year',$year],
              ['month',$month],
              ['location',$id],
              ['area', 1]
            ])
             ->update(['headoffice_expense' => $output['final_west_'.$i]]);
          }

          for ($i=1; $i < 3; $i++) {
            $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_central_location_'.$i])->get();
            $id = $location[0]->location_id;
            DB::table('final_result')->where([
              ['year',$year],
              ['month',$month],
              ['location',$id],
              ['area', 2]
            ])
             ->update(['headoffice_expense' => $output['final_central_'.$i]]);
          }

          for ($i=1; $i < 3; $i++) {
            $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_east_location_'.$i])->get();
            $id = $location[0]->location_id;
            DB::table('final_result')->where([
              ['year',$year],
              ['month',$month],
              ['location',$id],
              ['area', 3]
            ])
             ->update(['headoffice_expense' => $output['final_east_'.$i]]);
          }

          // update budget management
          for ($i=1; $i < 3; $i++) {
              $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_west_location_'.$i])->get();
              $id = $location[0]->location_id;
              DB::table('company_budget')
              ->where([
                ['area',1],
                ['location',$id],
                ['month',$output['month']],
                ['year',$output['year']]
              ])->update(
              ['division' => 1, 'revenue' => $output['area_west_revenue_'.$i], 'cost' => $output['area_west_cost_'.$i], 'profit' => $output['area_west_profit_'.$i], 'profit_rate' => $output['area_west_profitRate_'.$i], 'setting_rate' => $output['area_west_settingRate_'.$i], 'updated_at' => new DateTime, 'headoffice_expense' => $output['area_west_expense_'.$i]]);
          }

          for ($i=1; $i < 3; $i++) {
              $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_central_location_'.$i])->get();
              $id = $location[0]->location_id;
              DB::table('company_budget')->where([
                ['area',2],
                ['location',$id],
                ['month',$output['month']],
                ['year',$output['year']]
              ])
              ->update(
              ['division' => 1, 'revenue' => $output['area_central_revenue_'.$i], 'cost' => $output['area_central_cost_'.$i], 'profit' => $output['area_central_profit_'.$i], 'profit_rate' => $output['area_central_profitRate_'.$i], 'setting_rate' => $output['area_central_settingRate_'.$i], 'updated_at' => new DateTime, 'headoffice_expense' => $output['area_central_expense_'.$i]]);
          }

          for ($i=1; $i < 3; $i++) {
              $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_east_location_'.$i])->get();
              $id = $location[0]->location_id;
              DB::table('company_budget')
              ->where([
                ['area',3],
                ['location',$id],
                ['month',$output['month']],
                ['year',$output['year']]
              ])->update(
              ['division' => 1,'revenue' => $output['area_east_revenue_'.$i], 'cost' => $output['area_east_cost_'.$i], 'profit' => $output['area_east_profit_'.$i], 'profit_rate' => $output['area_east_profitRate_'.$i], 'setting_rate' => $output['area_east_settingRate_'.$i], 'updated_at' => new DateTime, 'headoffice_expense' => $output['area_east_expense_'.$i]]
              );
          }
          DB::table('sub_budget')
            ->where([
              ['month',$month],
              ['year',$year],
              ['area',1]
            ])
            ->update(
              ['division' => 1, 'revenue' => $output['company_west_sub_sale'], 'cost' => $output['company_west_sub_cost'], 'profit' => $output['company_west_sub_profit'], 'profit_rate' => $output['comapny_west_sub_profit_rate'], 'created_at' => new DateTime, 'headoffice_expense' => $output['comapny_west_sub_expense']]
            );
            DB::table('sub_budget')
              ->where([
                ['month',$month],
                ['year',$year],
                ['area',2]
              ])
              ->update(
                ['division' => 1, 'revenue' => $output['company_central_sub_sale'], 'cost' => $output['company_central_sub_cost'], 'profit' => $output['company_central_sub_profit'], 'profit_rate' => $output['company_central_sub_profit_rate'], 'created_at' => new DateTime, 'headoffice_expense' => $output['company_central_sub_expense']]
              );
              DB::table('sub_budget')
                ->where([
                  ['month',$month],
                  ['year',$year],
                  ['area',3]
                ])
                ->update(
                  ['division' => 1, 'revenue' => $output['company_east_sub_sale'], 'cost' => $output['company_east_sub_cost'], 'profit' => $output['company_east_sub_profit'], 'profit_rate' => $output['company_east_sub_profit_rate'], 'created_at' => new DateTime, 'headoffice_expense' => $output['company_east_sub_expense']]
                );

          DB::commit();
        }
        catch(\Exception $e)
      {
        DB::rollback();
        return $error = $e->getMessage();

      }
          //update data
          $insert = 0;
          $update = 1;
          $area_west_budget = DB::table('company_budget')
                              ->join('location_master','company_budget.location','=','location_master.location_id')
                              ->select('location_master.location_name','company_budget.revenue','company_budget.cost','company_budget.profit','company_budget.profit_rate','company_budget.setting_rate','company_budget.headoffice_expense')
                              ->where([
                                ['year','=', $output['year']],
                                ['month','=', $output['month']],
                                ['area','=', 1]
                              ])
                              ->get();
          $area_central_budget = DB::table('company_budget')
                              ->join('location_master','company_budget.location','=','location_master.location_id')
                              ->select('location_master.location_name','company_budget.revenue','company_budget.cost','company_budget.profit','company_budget.profit_rate','company_budget.setting_rate','company_budget.headoffice_expense')
                              ->where([
                                        ['year','=', $output['year']],
                                        ['month','=', $output['month']],
                                        ['area','=', 2]
                                      ])
                              ->get();
          $area_east_budget = DB::table('company_budget')
                               ->join('location_master','company_budget.location','=','location_master.location_id')
                               ->select('location_master.location_name','company_budget.revenue','company_budget.cost','company_budget.profit','company_budget.profit_rate','company_budget.setting_rate','company_budget.headoffice_expense')
                               ->where([
                                          ['year','=', $output['year']],
                                          ['month','=', $output['month']],
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
                                $l = 0;
                                $j = 0;
                                $k = 0;
                                if(session_status()===PHP_SESSION_NONE){
                                   session_start();
                                  if($_SESSION['role']=='admin'){
                                    return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east'));
                                  }
                                  else {
                                    return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east'));
                                  }
                                   }
                                elseif (session_status()===PHP_SESSION_ACTIVE)
                                {
                                  if($_SESSION['role']=='admin'){
                                    return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east'));
                                  }
                                  else {

                                    return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east'));
                                  }
                                }
        }

    }
    public function budgetAdminDate(Request $request)
    {
      $month = (int)$request->month;
      $year = (int)$request->year;

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
      $sub_budget_west = DB::table('sub_budget')
                                             ->select('revenue','cost','headoffice_expense','profit','profit_rate')
                                             ->where([
                                               ['month','=',$month],
                                               ['year','=',$year],
                                               ['area','=',1]
                                             ])
                                             ->get();
      $sub_budget_central = DB::table('sub_budget')
                                             ->select('revenue','cost','headoffice_expense','profit','profit_rate')
                                             ->where([
                                               ['month','=',$month],
                                               ['year','=',$year],
                                               ['area','=',2]
                                             ])
                                             ->get();
      $sub_budget_east = DB::table('sub_budget')
                                             ->select('revenue','cost','headoffice_expense','profit','profit_rate')
                                             ->where([
                                                ['month','=',$month],
                                                ['year','=',$year],
                                                ['area','=',3]
                                              ])
                                              ->get();
                                              //
      $sub_forecast_west = DB::table('sub_forecast')
                        ->select('revenue','cost','headoffice_expense','profit','profit_rate')
                                                                ->where([
                                                                   ['month','=',$month],
                                                                   ['year','=',$year],
                                                                   ['area','=',1]
                                                                 ])
                                                                 ->get();
      $sub_forecast_central = DB::table('sub_forecast')
                                                                ->select('revenue','cost','headoffice_expense','profit','profit_rate')
                                                                ->where([
                                                                      ['month','=',$month],
                                                                      ['year','=',$year],
                                                                      ['area','=',2]
                                                                    ])
                                                                    ->get();
      $sub_forecast_east = DB::table('sub_forecast')
                                                                ->select('revenue','cost','headoffice_expense','profit','profit_rate')
                                                                ->where([
                                                                      ['month','=',$month],
                                                                      ['year','=',$year],
                                                                      ['area','=',3]
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
                  $update = 0;
                  if(session_status()===PHP_SESSION_NONE){
                     session_start();
                     if($_SESSION['role']=='admin'){
                       return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east','sub_forecast_west','sub_forecast_central','sub_forecast_east'));
                              }
                      else {
                        return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east','gross','sub_budget_west','sub_budget_central','sub_budget_east'));
                            }
                      }
                      elseif (session_status()===PHP_SESSION_ACTIVE)
                      {
                        if($_SESSION['role']=='admin'){
                          return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east','sub_forecast_west','sub_forecast_central','sub_forecast_east'));
                       }
                       else {

                         return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update','location_forecast_west','location_forecast_central','location_forecast_east','location_final_west','location_final_central','location_final_east','gross','sub_budget_west','sub_budget_central','sub_budget_east'));
                        }
                    }
}
}
