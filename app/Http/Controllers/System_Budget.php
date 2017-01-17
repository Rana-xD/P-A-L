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
      $area_west_budget = DB::table('company_budget')
                          ->join('location_master','company_budget','');
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
          return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k'));
        }
        else {
          return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k'));
        }
         }
      elseif (session_status()===PHP_SESSION_ACTIVE)
      {
        if($_SESSION['role']=='admin'){
          return view ('admin.BudgetManagement',compact('area_west','area_central','area_east','l','j','k'));
        }
        else {
          return view ('manager.BudgetManagement',compact('area_west','area_central','area_east','l','j','k'));
        }
      }
    }
    public function budgetAdmin(Request $request)
    {

        // get month and year input
        $output['month'] = $request->month_a;
        $output['year'] = $request->year_a;

        $output['area_west_location_1'] = $request->area_west_location_1;
        $output['area_west_revenue_1'] = $request->area_west_revenue_1;
        $output['area_west_cost_1'] = $request->area_west_cost_1;
        $output['area_west_profit_1'] = $request->area_west_profit_1;
        $output['area_west_profitRate_1'] = $request->area_west_profitRate_1;
        $output['area_west_settingRate_1'] = $request->area_west_settingRate_1;

        $output['area_west_location_2'] = $request->area_west_location_2;
        $output['area_west_revenue_2'] = $request->area_west_revenue_2;
        $output['area_west_cost_2'] = $request->area_west_cost_2;
        $output['area_west_profit_2'] = $request->area_west_profit_2;
        $output['area_west_profitRate_2'] = $request->area_west_profitRate_2;
        $output['area_west_settingRate_2'] = $request->area_west_settingRate_2;

        $output['area_central_location_1'] = $request->area_central_location_1;
        $output['area_central_revenue_1'] = $request->area_central_revenue_1;
        $output['area_central_cost_1'] = $request->area_central_cost_1;
        $output['area_central_profit_1'] = $request->area_central_profit_1;
        $output['area_central_profitRate_1'] = $request->area_central_profitRate_1;
        $output['area_central_settingRate_1'] = $request->area_central_settingRate_1;

        $output['area_central_location_2'] = $request->area_central_location_2;
        $output['area_central_revenue_2'] = $request->area_central_revenue_2;
        $output['area_central_cost_2'] = $request->area_central_cost_2;
        $output['area_central_profit_2'] = $request->area_central_profit_2;
        $output['area_central_profitRate_2'] = $request->area_central_profitRate_2;
        $output['area_central_settingRate_2'] = $request->area_central_settingRate_2;

        $output['area_east_location_1'] = $request->area_east_location_1;
        $output['area_east_revenue_1'] = $request->area_east_revenue_1;
        $output['area_east_cost_1'] = $request->area_east_cost_1;
        $output['area_east_profit_1'] = $request->area_east_profit_1;
        $output['area_east_profitRate_1'] = $request->area_east_profitRate_1;
        $output['area_east_settingRate_1'] = $request->area_east_settingRate_1;

        $output['area_east_location_2'] = $request->area_east_location_2;
        $output['area_east_revenue_2'] = $request->area_east_revenue_2;
        $output['area_east_cost_2'] = $request->area_east_cost_2;
        $output['area_east_profit_2'] = $request->area_east_profit_2;
        $output['area_east_profitRate_2'] = $request->area_east_profitRate_2;
        $output['area_east_settingRate_2'] = $request->area_east_settingRate_2;

        for ($i=1; $i < 3; $i++) {
            $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_west_location_'.$i])->get();
            $id = $location[0]->location_id;
            DB::table('company_budget')->insert(
            ['division' => 1,'area' => 1, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['area_west_revenue_'.$i], 'cost' => $output['area_west_cost_'.$i], 'profit' => $output['area_west_profit_'.$i], 'profit_rate' => $output['area_west_profitRate_'.$i], 'setting_rate' => $output['area_west_settingRate_'.$i], 'created_at' => new DateTime]
            );
        }

        for ($i=1; $i < 3; $i++) {
            $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_central_location_'.$i])->get();
            $id = $location[0]->location_id;
            DB::table('company_budget')->insert(
            ['division' => 1,'area' => 2, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['area_central_revenue_'.$i], 'cost' => $output['area_central_cost_'.$i], 'profit' => $output['area_central_profit_'.$i], 'profit_rate' => $output['area_central_profitRate_'.$i], 'setting_rate' => $output['area_central_settingRate_'.$i], 'created_at' => new DateTime]
            );
        }

        for ($i=1; $i < 3; $i++) {
            $location = DB::table('location_master')->select('location_id')->where('location_name','=',$output['area_east_location_'.$i])->get();
            $id = $location[0]->location_id;
            DB::table('company_budget')->insert(
            ['division' => 1,'area' => 3, 'location' => $id, 'year' => $output['year'], 'month' => $output['month'], 'revenue' => $output['area_east_revenue_'.$i], 'cost' => $output['area_east_cost_'.$i], 'profit' => $output['area_east_profit_'.$i], 'profit_rate' => $output['area_east_profitRate_'.$i], 'setting_rate' => $output['area_east_settingRate_'.$i], 'created_at' => new DateTime]
            );
        }
        echo "success";





    }
    public function budgetAdminDate(Request $request)
    {
        return $request->all();
    }
}
