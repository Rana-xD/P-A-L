<!DOCTYPE html>
<html>
<head>
	<title>PAL</title>
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="/js/script.js"></script>
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
