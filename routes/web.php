<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('main');
});
Route::post('/api/workshift', 'System_Work_Shift@ajax_work_shift');

Route::post('login','login@login');



Route::get('time_management', function () {
  if(session_status()===PHP_SESSION_NONE){
     session_start();
    if($_SESSION['role']=='admin'){
      return view ('admin.TimeManagementLocation');
    }
    else {
      return view ('manager.TimeManagementLocation');
    }
     }
  elseif (session_status()===PHP_SESSION_ACTIVE)
  {
    if($_SESSION['role']=='admin'){
      return view ('admin.TimeManagementLocation');
    }
    else {
      return view ('manager.TimeManagementLocation');
    }
  }
});


Route::get('budget/','System_Budget@budget');
Route::get('kpi','System_KPI@kpi');
Route::post('task','login@task');
Route::post('kpi-data','System_KPI@kpiData');
Route::post('budget-admin','System_Budget@budgetAdmin');
Route::post('budget-admin-date','System_Budget@budgetAdminDate');
Route::post('budget-manager','System_Budget_Manager@budgetManager');
