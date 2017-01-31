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
             return redirect ('worker');
         }
         else if (($name=="manager_yamanaka") || ($name=="Manager_yamanaka"))
         {
             session_start();
             $_SESSION['role'] = 'manager';
             $_SESSION['location'] = 2;
             return view ('manager.TimeManagementLocation');
         }
         else if (($name=="manager_tokyo") || ($name=="Manager_tokyo"))
         {
             session_start();
             $_SESSION['role'] = 'manager';
             $_SESSION['location'] = 1;
             return view ('manager.TimeManagementLocation');
         }
         else if (($name=="admin") || ($name=="Admin")) {
             session_start();
             $_SESSION['role'] = 'admin';
             $_SESSION['location'] = 0;
             return view ('admin.TimeManagementLocation');
         }
         else {
             return redirect('/');
         }

    }
    
}
