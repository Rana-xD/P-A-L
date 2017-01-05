<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use View;
use App\Http\Controllers\info;
use Illuminate\Support\Collection;

class login extends Controller
{

    public function login(Request $request)
    {
      $this->validate($request, [
     'name' => 'required',
     'password' => 'required',
        ]);
         $name = $request->name;
         $password = $request->password;

         if(($name=="worker") || ($name=="Worker"))
         {
             return view ('TimeManagementIndividual');
         }
         else if (($name=="manager") || ($name=="Manager"))
         {
             session_start();
             $_SESSION['role'] = 'manager';
             return view ('manager.TimeManagementLocation');
         }
         else if (($name=="admin") || ($name=="Admin")) {
             session_start();
             $_SESSION['role'] = 'admin';
             return view ('admin.TimeManagementLocation');
         }
         else {
             return redirect('/');
         }

    }
    public function task(Request $request)
    {
        // filter time input
        $start_hour = $request->input('start_hour');
        $start_minute = $request->input('start_minute');
        $stop_hour = $request->input('stop_hour');
        $stop_minute = $request->input('stop_minute');
        $total = $stop_hour - $start_hour;

        // cocatenate hour with minute
        $start_time = $start_hour.':'.$start_minute;
        $stop_time = $stop_hour.':'.$stop_minute;

        // filter only tasks data input
        $data = $request->except(['_token','stop_minute','stop_hour','start_minute','start_hour']);

        // loop through tasks data
        foreach ($data as $key => $value) {
            $output[$key] = $value;
        }

        // assign new time
        $output['start_time'] = $start_time;
        $output['stop_time'] = $stop_time;
        $output['total'] = $total;
        return $output;
        // return data
        return view('admin.TimeManagementLocation',compact('output'));

    }
}
