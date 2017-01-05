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

Route::get('budget',function(){
  if(session_status()===PHP_SESSION_NONE){
     session_start();
    if($_SESSION['role']=='admin'){
      return view ('admin.BudgetManagement');
    }
    else {
      return view ('manager.BudgetManagement');
    }
     }
  elseif (session_status()===PHP_SESSION_ACTIVE)
  {
    if($_SESSION['role']=='admin'){
      return view ('admin.BudgetManagement');
    }
    else {
      return view ('manager.BudgetManagement');
    }
  }
});

Route::get('kpi','System@kpi');
Route::post('task','login@task');
