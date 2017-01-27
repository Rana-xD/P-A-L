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
                        <label>Location : </label>
                        <select name="location" id="location" class="custom_select">
                            <option hidden></option>
                            @foreach($locations as $loc)
                            <option {{ $default == $loc->location_id ? 'selected="selected"' : '' }} value="{{ $loc->location_id }}">{{ $loc->location_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Staff : </label>
                        <select name="staff" id="staff_list" class="custom_select">
                            @foreach($staff as $worker)
                            <option value="{{ $worker->id }}">{{ $worker->staff_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    </select>
                </div>
                <!-- /Chosse Location and Staff -->
                <div class="row">
                    <div class="time-range">

                        <div class="from">
                        	<div class="heading">
                        		<h4>
                        			Time in
                        		</h4>
                        	</div>
                            <div class="hour" id="from-hour">
                                <span class="increase increaseHour">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <input name="start_hour"
                                       type="text"
                                       class="time-input"
                                       value="06">
                                <span class="decrease decreaseHour">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </div>

                            <div class="semicolon">
                            	<h4>:</h4>
                            </div>

                            <div class="minute" id="from-minute">
                                <span class="increase increaseMinute">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <input name="start_minute"
                                       type="text"
                                       class="time-input"
                                       value="00">
                                <span class="decrease decreaseMinute">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </div>
                        </div>

                        <div class="divider">
                        	<h1>
                        		~
                        	</h1>
                        </div>

                        <div class="to">
                        	<div class="heading">
                        		<h4>
                        			Time out
                        		</h4>
                        	</div>
                            <div class="hour" id="to-hour">
                                <span class="increase increaseHour">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <input name="stop_hour"
                                       type="text"
                                       class="time-input"
                                       value="06">
                                <span class="decrease decreaseHour">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </div>
                            <div class="semicolon">
                            	<h4>:</h4>
                            </div>
                            <div class="minute" id="to-minute">
                                <span class="increase increaseMinute">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <input name="stop_minute"
                                       type="text"
                                       class="time-input"
                                       value="00">
                                <span class="decrease decreaseMinute">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </div>

                        </div>

                        <div class="rest-hour">
                        	<div class="heading">
                        		<h4>Rest</h4>
                        	</div>
                        	<div class="minute">
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


                            <ul class="hours-range">

                            </ul>
                            <div class="submit-div">
                                <input type="submit" class="submit" value="Submit">
                            </div>

                    </div>
                </div>
                </div>
            </form>
        </div>

  </body>
</body>
</html>
