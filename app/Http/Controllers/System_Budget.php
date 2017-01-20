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
          return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
        }
        else {
          return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
        }
         }
      elseif (session_status()===PHP_SESSION_ACTIVE)
      {
        if($_SESSION['role']=='admin'){
          return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
        }
        else {

          return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
        }
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


          $l = 0;
          $j = 0;
          $k = 0;

          if(session_status()===PHP_SESSION_NONE){
             session_start();
            if($_SESSION['role']=='admin'){
              return view ('admin.BudgetManagement',compact('l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
            }
            else {
              return view ('manager.BudgetManagement',compact('l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
            }
             }
          elseif (session_status()===PHP_SESSION_ACTIVE)
          {
            if($_SESSION['role']=='admin'){
              return view ('admin.BudgetManagement',compact('l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
            }
            else {
              return view ('manager.BudgetManagement',compact('l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
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


          $l = 0;
          $j = 0;
          $k = 0;
          if(session_status()===PHP_SESSION_NONE){
             session_start();
            if($_SESSION['role']=='admin'){
              return view ('admin.BudgetManagement',compact('l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
            }
            else {
              return view ('manager.BudgetManagement',compact('l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
            }
             }
          elseif (session_status()===PHP_SESSION_ACTIVE)
          {
            if($_SESSION['role']=='admin'){
              return view ('admin.BudgetManagement',compact('l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
            }
            else {
              return view ('manager.BudgetManagement',compact('l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
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
      $insert = 0;
      $update = 0;
      if(session_status()===PHP_SESSION_NONE){
         session_start();
        if($_SESSION['role']=='admin'){
          return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
        }
        else {
          return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
        }
         }
      elseif (session_status()===PHP_SESSION_ACTIVE)
      {
        if($_SESSION['role']=='admin'){
          return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
        }
        else {
          return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k','area_west_budget','area_central_budget','area_east_budget','month','year','insert','update'));
        }
      }
    }
}
