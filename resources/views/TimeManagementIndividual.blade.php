<!DOCTYPE html>
<html>
<head>
	<title>PAL</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{!! csrf_token() !!}" />
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome.css">
	<script src="/js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"><\/script>')</script>
	<script src="/js/script.js"></script>
    <script src="/js/time_management_individaul.js"></script>
    {{-- <script src="/js/validationcheck.js"></script> --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="sweetalert.css">
    <style>
        .row{
            position: relative;
            width: 100%;
        }

        .location_staffs{
            margin-top: 20px;
        }

        .location_staffs select{
            padding: 7px 10px;
            min-width: 150px;
            outline: none;
            border: 1px solid #f5f5f5;
            background: #fff;
            box-shadow: 0px 1px 2px rgba(0,0,0,0.1);
        }

        .row::before,
        .row::after{
            display: table;
            content: "";
            position: relative;
            height: 1px;
        }
        .row::after{
            clear: both;
            zoom: 1;
        }
        .form-group{
            position: relative;
            width: 100%;
            float: left;
            padding: 5px 0;
            margin-bottom: 10px;
        }

        .form-group .inline{
            float: left;
            width: 250px;
        }

        table.schedule_tb{
            width: 300px;
            border-collapse: collapse;
            background: #fff;
        }

        table.schedule_tb th,
        table.schedule_tb td{
            padding: 6px 4px;
            text-align: center;
        }

        table.schedule_tb th.dark{
            background-color: #f5f5f5;
        }

        .content .tasks-range{
            width: 2160px;
        }

        .bulk-reset-action{
            display: none;
        }

        .bulk-task-shortcut{
            display: none;
        }
        #hours-range .task-hour .tasks-select.visible{
            visibility: visible;
        }
        #hours-range .task-hour .tasks-select.hide{
            visibility: hidden;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="container">
        <div class="logo">
            <h1>
                {{-- <img src="http://www.pal-style.co.jp/img/hdr-logo.png" alt=""> --}}
                PAL
            </h1>
        </div>
        {{-- <div class="navbar">
            <nav class="global_nav">
                <ul>
                    <li><a href="">Time Management</a></li>
                    <li><a href="">Budget Management</a></li>
                    <li><a href="">Account Management</a></li>
                    <li><a href="">Shift Table</a></li>
                </ul>
            </nav>
        </div> --}}
    </div>
</div>
<div class="container">
	<form class="tasks-form" action="task" method="POST">
        {{ csrf_field() }}
            <div class="content">
                <!-- Chosse Location and Staff -->
                <div class="row location_staffs">
                    <div class="form-group">
					   <div class="date-schedule">
						  <h4>
							Select date :
						  </h4>
						<input type="text" id="date" name="date" ng-model="date" class="datepicker alert" ng-readonly="true" ng-required="true">
						<p class="custom-error date-err ng-hide" ng-show="input_form.date.$touched && input_form.date.$error.required">This field is required</p>
						<input type="hidden" name="current_date" id="current_date">
						</div>
                        <div class="inline">
                            <label>Location : </label>
                            <select name="location" id="location" class="custom_select">
                                <option hidden></option>
                                @foreach($locations as $loc)
                                <option {{ $default == $loc->location_id ? 'selected="selected"' : '' }} value="{{ $loc->location_id }}">{{ $loc->location_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="inline">
                            <label>Staff : </label>
                            <select name="staff" id="staff_list" class="custom_select">
                                <option hidden></option>
                                @foreach($staff as $worker)
                                <option value="{{ $worker->id }}">{{ $worker->staff_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="shift_schedule" class="form-group">

                    </div>

                    </select>
                </div>
                <!-- /Chosse Location and Staff -->
                <div class="row">
                    <div class="time-range validate-hour-range">

                        <div class="from time-group">
                        	<div class="heading">
                        		<h4>
                        			Time in
                        		</h4>
                        	</div>
                            <div class="hour" id="from-hour">
                                <span class="increase hour increaseHour">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <input name="start_hour"
                                       type="text"
                                       class="time-input"
                                       value="06">
                                <span class="decrease hour decreaseHour">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </div>

                            <div class="semicolon">
                            	<h4>:</h4>
                            </div>

                            <div class="minute" id="from-minute">
                                <span class="increase minute increaseMinute">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <input name="start_minute"
                                       type="text"
                                       class="time-input"
                                       value="00">
                                <span class="decrease minute decreaseMinute">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </div>
                        </div>

                        <div class="divider">
                        	<h1>
                        		~
                        	</h1>
                        </div>

                        <div class="to time-group">
                        	<div class="heading">
                        		<h4>
                        			Time out
                        		</h4>
                        	</div>
                            <div class="hour" id="to-hour">
                                <span class="increase hour increaseHour">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <input name="stop_hour"
                                       type="text"
                                       class="time-input"
                                       value="17">
                                <span class="decrease hour decreaseHour">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </div>
                            <div class="semicolon">
                            	<h4>:</h4>
                            </div>
                            <div class="minute" id="to-minute">
                                <span class="increase minute increaseMinute">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <input name="stop_minute"
                                       type="text"
                                       class="time-input"
                                       value="00">
                                <span class="decrease minute decreaseMinute">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </div>

                        </div>

                        <div class="rest-hour">
                        	<div class="heading">
                        		<h4>Rest</h4>
                        	</div>
                        	<div class="minute" id="rest_minute">
                        		<span class="increase increaseMinute">
                        			<i class="fa fa-plus"></i>
                        		</span>

                        		<input name="rest_minute"
                        		       type="text"
                        		       value="00"
                        		       class="time-input">

                        		<span class="decrease decreaseMinute">
                        			<i class="fa fa-minus"></i>
                        		</span>
                        	</div>
                        	<div class="unit">
                        		<h1>
                        			mn
                        		</h1>
                        	</div>
                        </div>

                    </div>
                </div>

                <div class="row bulk-action">
                    <div class="form-group">
                        <label for="bulk-action-select">Shortcut action : </label>
                        <select id="bulk-action-select" class="bulk-action-select custom-select">
                            <option disabled="disabled" selected></option>
                            <option value="0">Multiple tasks with one click</option>
                            <option value="1">Reset</option>
                        </select>
                        <div class="action-form">
                            <div class="bulk-reset-action">
                                <button class="preventSubmit" onclick="triggerShortcutTask('1')">Reset tasks</button>
                            </div>

                            <div id="bulk-task-shortcut" class="bulk-task-shortcut">
                                <select id="bulk_action_time_in" class="bulk_action_time_in">
                                    <option disabled="disabled" selected>From time</option>

                                </select>
                                <select id="bulk_action_time_out" class="bulk_action_time_out">
                                    <option disabled="disabled" selected>To time</option>

                                </select>
                                <select class="bulk_action_tasks" id="bulk_action_tasks">
                                    <option disabled="disabled" selected>Select task</option>
                                    @foreach($process as $task)
                                    <option value="{{$task->id}}">{{$task->process_name}}</option>
                                    @endforeach
                                    <option value="R">Rest</option>
                                </select>
                                <button class="preventSubmit" onclick="triggerShortcutTask('0')">Select Now</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row task-container">
                    <div class="tasks-range">

                    	<div class="time-bar">
                    		<span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                            <span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                            <span></span>
                    		<span></span>
                    		<span></span>
                    		<span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                    	</div>


                            <ul id="hours-range" class="hours-range">
                            @for($i=6;$i<36;$i++)
                                <li class="task-hour">
                                    <div class="tasks">
                                        <div class="task">
                                            <select name="hour_{{$i}}_1" class="tasks-select">
                                                <option value="A"></option>
                                                @foreach($process as $task)
                                                <option value="{{$task->id}}">{{$task->process_name}}</option>
                                                @endforeach
                                                <option value="R">Rest</option>
                                            </select>
                                        </div>
                                        <div class="task">
                                            <select name="hour_{{$i}}_2" class="tasks-select">
                                                <option value="A"></option>
                                                @foreach($process as $task)
                                                <option value="{{$task->id}}">{{$task->process_name}}</option>
                                                @endforeach
                                                <option value="R">Rest</option>
                                            </select>
                                        </div>
                                        <div class="task">
                                            <select name="hour_{{$i}}_3" class="tasks-select">
                                                <option value="A"></option>
                                                @foreach($process as $task)
                                                <option value="{{$task->id}}">{{$task->process_name}}</option>
                                                @endforeach
                                                <option value="R">Rest</option>
                                            </select>
                                        </div>
                                        <div class="task">
                                            <select name="hour_{{$i}}_4" class="tasks-select">
                                                <option value="A"></option>
                                                @foreach($process as $task)
                                                <option value="{{$task->id}}">{{$task->process_name}}</option>
                                                @endforeach
                                                <option value="R">Rest</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            @endfor
                            </ul>
                            <div class="submit-div">
                                <input type="submit" class="submit" value="Submit">
                            </div>

                    </div>
                </div>
                </div>
            </form>
        </div>
        <script>
        $(function(){
          $('.datepicker').datepicker({
            maxDate: new Date()
          });
        });
        </script>
  </body>
</body>
</html>
