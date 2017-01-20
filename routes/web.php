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

Route::post('login','login@login');

Route::get('budget', function () {
  if(session_status()===PHP_SESSION_NONE){
     session_start();
    if($_SESSION['role']=='admin'){
      return view ('admin.BudgetManagement');
    }
    else {

    }
     }
  elseif (session_status()===PHP_SESSION_ACTIVE)
  {
    if($_SESSION['role']=='admin'){
      return view ('admin.BudgetManagement');
    }
    else {

    }
  }

});

Route::get('work', function () {
  if(session_status()===PHP_SESSION_NONE){
     session_start();
    if($_SESSION['role']=='admin'){
      return view ('admin.WorkShift');
    }
    else {
      return view ('manager.WorkShift');
    }
     }
  elseif (session_status()===PHP_SESSION_ACTIVE)
  {
    if($_SESSION['role']=='admin'){
      return view ('admin.WorkShift');
    }
    else {
      return view ('manager.WorkShift');
    }
  }
});

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


Route::get('budget','System_Budget@budget');
Route::get('kpi','System_KPI@kpi');
Route::post('task','login@task');
Route::post('kpi-data','System_KPI@kpiData');
Route::post('budget-admin','System_Budget@w');
Route::post('budget-admin-date','System_Budget@budgetAdminDate');
