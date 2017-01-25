<!DOCTYPE html>
<html>
<head>
	<title>Work shift</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{!! csrf_token() !!}" />
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome.min.css">
	<script src="/js/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"><\/script>')</script>

		<script type="text/javascript">
			$(document).ready(function() {
				var month = @php
		 			echo $month;
		 		@endphp;
		 		var year = @php
		 			echo $year;
		 		@endphp;
				var location = @php
					echo $location;
				@endphp;

		 		$('#month').val(month);
		 		$('#year').val(year);
				$('#location').val(location);

			});
		</script>

		<script src="/js/script.js"></script>
		<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	<style>
		.sel-box {
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
    		padding: 4px;
    		width: 100%;
    		border: none;
		}
		table {
				border-collapse: collapse;
				width: 100%;
				background: #f6f6f6;
				border: 1px solid #38678f;
				table-layout: fixed;
		}
		th {
				color: #ffffff;
				background: #27ae60;
				padding:8px 4px;
				text-align: center;
				border: 1px solid #c4c4c4;
		}
		td {
				text-align: left;
				border: 1px solid #c4c4c4;
		}
		.page-content{
			position: relative;
			width: 100%;
			box-sizing: border-box;
			padding-bottom: 40px;
			padding-left: 30px;
			padding-right: 30px;
			padding-top: 40px;
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
	        <div class="navbar">
	            <nav class="global_nav">
	                <ul>
										<li><a href="time_management">Time Management</a></li>
                    <li><a href="budget">Budget Management</a></li>
                    {{-- <li><a href="kpi">L-KPI</a></li> --}}
										<li><a href="work">Shift Table</a></li>
	                </ul>
	            </nav>
	        </div>
	    </div>
	</div>
	<div class="page-content">
		<div class="container">
			<div>
				Select location
				<select name="location" id="location" style="margin-left: 1em; margin-right: 5em;">
					<option value="" selected hidden></option>
					<option value="1">Tokyo</option>
					<option value="2">Yamanaka</option>
				</select>
				<label for="month">Select a month</label>
				<select id="month" name="month" style="margin-left: 5px; margin-right: 30px; width: 100px">
					<option value="" selected hidden></option>
					<option value="1" id="1">JANUARY</option>
					<option value="2" id="2">FEBRAURY</option>
					<option value="3" id="3">MARCH</option>
					<option value="4" id="4">APRIL</option>
					<option value="5" id="5">MAY</option>
					<option value="6" id="6">JUNE</option>
					<option value="7" id="7">JULY</option>
					<option value="8" id="8">AUGUST</option>
					<option value="9" id="9">SEPTEMBER</option>
					<option value="10" id="10">OCTOBER</option>
					<option value="11" id="11">NOVEMBER</option>
					<option value="12" id="12">DECEMBER</option>
				</select>
				<label for="year">Select Year</label>
				<select id="year" name="year">
					<option value="" selected hidden></option>
					@php

						$curYear = Date("Y");
						for($i=2000; $i <= $curYear; $i++){
							echo "<option value='$i' id='$i'>$i</option>";
						}
					@endphp
				</select>
				<br>
				<br>
				<br>
			</div>
			<div>
				<table>
					<thead>
						<tr id="date_header">

						</tr>
					</thead>
					<tbody>
						@foreach ($staff as $key)
							<tr>
								<td>{{ ++$k }}</td>
								<td>{{ $key->staff_name }}</td>
								@for($i=0;$i<count($key->work_shift);$i++)
								<td><select class="sel-box">
										<option hidden></option>
										<option {{ $key->work_shift[$i] == 0 ? 'selected="selected"' : ''}} value="0">X</option>
										<option {{ $key->work_shift[$i] == 1 ? 'selected="selected"' : ''}}  value="1">O</option>
									</select>
								</td>
								@endfor
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<br>
			<br>
			<div>
				{{-- <div class="fileupload">
					<input id="file" class="uploadfile" type="file" name="files" data-multiple-caption="{count} files selected" multiple />
					<label for="file">Choose file</label>
				</div> --}}

			</div>
		</div>
	</div>


</body>
</html>
