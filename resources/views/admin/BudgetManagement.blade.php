<!DOCTYPE html>
<html>
	<head>
		<title>Budget Management</title>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/css/styles.css">
		<link rel="stylesheet" type="text/css" href="/fonts/font-awesome.min.css">
		<script src="/js/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"><\/script>')</script>
		<script src="/js/script.js"></script>
		<!--[if lt IE 9]>
      	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
			<script type="text/javascript">

				$(document).ready(function() {
					var month = @php
						echo $month;
					@endphp;
					var year = @php
						echo $year;
					@endphp;
					$('#month').val(month);
					$('#month_a').val(month);
					$('#year').val(year);
					$('#year_a').val(year);

					$('#month').on('change', function (e) {

					var optionSelected = $("option:selected", this);
					var valueSelected = this.value;
					$('#month_a').val(valueSelected);
					});
					$('#year').on('change', function (e) {

					var optionSelected = $("option:selected", this);
					var valueSelected = this.value;
					$('#year_a').val(valueSelected);
					});

					var elew = $('#west .revenue')[0];
					calcSubTotal(elew);
					var elec = $('#central .revenue')[0];
					calcSubTotal(elec);
					var elee = $('#east .revenue')[0];
					calcSubTotal(elee);
				});
			</script>
		<style>
			table.scroll {
				border-collapse: collapse;
				border-spacing: 0;
				background: #f6f6f6;
				width: 3000px;
				overflow: auto;

			}

			table.scroll tbody,
			table.scroll thead {
				width: auto;
			}

			table.scroll tbody {
				height: 100px;
			    overflow-y: auto;
			    overflow-x: auto;
			}

			th {
				background-color: #f2f2f2;
				color: #ffffff;
				background: #27ae60;
				padding: 8px 4px;
				text-align: left;
			}
			tr:nth-child(odd) {
				background: #e9e9e9;
			}

			tr:last-child {
				font-weight: bold;
			}
			td {
				text-align: left;
				padding: 4px;
			}
			.setting-rate-box {
				width: 100px;
			}
			.page-content{
				position: relative;
				width: 100%;
				box-sizing: border-box;
				padding-bottom: 40px;
				padding-left: 40px;
				padding-right: 40px;
			}

			select{
				border: none;
				padding: 5px 10px;
				background: #fff;
				font-family: "Raleway", sans-serif;
				font-size: 15px;
				box-shadow: 1px 0px 1px rgba(0,0,0,0.2);
			}
		</style>

	</head>
	<body>
		@if (empty($area_west_budget[0]))
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
	                    <li><a href="/time_management">Time Management</a></li>
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
					<form action="budget-admin-date" method="POST">
						{{ csrf_field() }}
					<div style="margin-top: 20px">
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

						<label for="year">Year</label>
						<select id="year" name="year">
							<option value="" selected hidden></option>
							@php

								$curYear = Date("Y");
								for($i=2000; $i <= $curYear; $i++){
									echo "<option value='$i' id='$i'>$i</option>";
								}
							@endphp
						</select>
						<button type="submit" class="btn-sumit">Done</button>
					</div>
					</form>
					</br>
					<hr>
					<form action="budget-admin" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="month_a" id="month_a">
						<input type="hidden" name="year_a" id="year_a">
					<div class="tables-content">

						<div class="indi-area">
							<div class="area-heading">
								<h2>
									AREA WEST
								</h2>
							</div>
							<table class="scroll">
								<thead>
									<tr>
										<th style="background: transparent; padding-left: 30px;"></th>
										<th style="background: #e74c3c; padding-left: 30px;" colspan="5">予算</th>
										<th style="background: #2ecc71; padding-left: 30px;" colspan="4">予測</th>
										<th style="background: #3498db; padding-left: 30px;" colspan="5">進捗</th>
										<th style="background: #f1c40f; padding-left: 30px;" colspan="5">確定数値</th>
									</tr>
									<tr>
										<th>Location</th>
										<th>Sales</th>
										<th>Cost</th>
										<th>Profit</th>
										<th>Profit rate</th>
										<th>Setting rate</th>

										<th>Sales</th>
										<th>Cost</th>
										<th>Profit</th>
										<th>Profit rate</th>

										<th>Sales</th>
										<th>Cost</th>
										<th>Profit</th>
										<th>Profit rate</th>
										<th>Profit gap</th>

										<th>Sales</th>
										<th>Cost</th>
										<th>Profit</th>
										<th>Profit rate</th>
										<th>Profit gap</th>

									</tr>
								</thead>
								<tbody>
									@foreach ($area_west as $key)
									<tr class="record">
										<td>{{ $key->location_name }}
										<input type="hidden" name="area_west_location_{{ ++$j }}" value="{{ $key->location_name }}"></td>
										<td>
											<input type="text" value="" name="area_west_revenue_{{ $j }}" class="revenue-profit-input revenue">
										</td>
										<td>
											<input type="text" value="" name="area_west_cost_{{ $j }}" class="cost-profit-input cost">
										</td>
										<td class="profit">
											<span></span>
											<input type="hidden" class="hidden-profit" name="area_west_profit_{{ $j }}">
										</td>
										<td class="profit-rate">
											<span></span>
											<input type="hidden" class="hidden-profit-rate" name="area_west_profitRate_{{ $j }}">
										</td>
										<td>
											<input type="text" name="area_west_settingRate_{{ $j }}" class="setting-rate-box"> %
										</td>

										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											15%
										</td>

										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											15%
										</td>
										<td>
											&yen;400,000,00
										</td>

										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											15%
										</td>
										<td>
											&yen;400,000,00
										</td>

									</tr>
									@endforeach
									<tr class="subtotal">
										<td>Subtotal</td>
										<td class="sub-sale">
											<span></span>
											<input type="hidden" class="sub-sale-hidden" name="">
										</td>
										<td class="sub-cost">
											<span></span>
											<input type="hidden" class="sub-cost-hidden" name="">
										</td>
										<td class="sub-profit">
											<span></span>
											<input type="hidden" class="sub-profit-hidden" name="">
										</td>
										<td class="sub-profit-rate">
											<span></span>
											<input type="hidden" class="sub-rate-hidden" name="">
										</td>
										<td><input type="text" name="" class="sub-setting-rate-box"> %</td>
									</tr>
								</tbody>
							</table>
							<hr>
						</div>

						<div class="indi-area">
							<div class="area-heading">
								<h2>
									AREA CENTRAL
								</h2>
							</div>
							<table class="scroll">
								<thead>
									<tr>
										<th style="background: transparent; padding-left: 30px;"></th>
										<th style="background: #e74c3c; padding-left: 30px;" colspan="5">予算</th>
										<th style="background: #2ecc71; padding-left: 30px;" colspan="4">予測</th>
										<th style="background: #3498db; padding-left: 30px;" colspan="5">進捗</th>
										<th style="background: #f1c40f; padding-left: 30px;" colspan="5">確定数値</th>
									</tr>
									<tr>
										<th>Location</th>
										<th>Sales</th>
										<th>Cost</th>
										<th>Profit</th>
										<th>Profit rate</th>
										<th>Setting rate</th>

										<th>Sales</th>
										<th>Cost</th>
										<th>Profit</th>
										<th>Profit rate</th>

										<th>Sales</th>
										<th>Cost</th>
										<th>Profit</th>
										<th>Profit rate</th>
										<th>Profit gap</th>

										<th>Sales</th>
										<th>Cost</th>
										<th>Profit</th>
										<th>Profit rate</th>
										<th>Profit gap</th>

									</tr>
								</thead>
								<tbody>
									@foreach ($area_central as $key)
									<tr class="record">
										<td>{{ $key->location_name }}
										<input type="hidden" name="area_central_location_{{ ++$l }}" value="{{ $key->location_name }}"></td>
										<td>
											<input type="text" value="" name="area_central_revenue_{{ $l }}" class="revenue-profit-input revenue">
										</td>
										<td>
											<input type="text" value="" name="area_central_cost_{{ $l }}" class="cost-profit-input cost">
										</td>
										<td class="profit">
											<span></span>
											<input type="hidden" class="hidden-profit" name="area_central_profit_{{ $l }}">
										</td>
										<td class="profit-rate">
											<span></span>
											<input type="hidden" class="hidden-profit-rate" name="area_central_profitRate_{{ $l }}">
										</td>
										<td>
											<input type="text" name="area_central_settingRate_{{ $l }}" class="setting-rate-box"> %
										</td>

										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											15%
										</td>

										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											15%
										</td>
										<td>
											&yen;400,000,00
										</td>

										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											15%
										</td>
										<td>
											&yen;400,000,00
										</td>

									</tr>
									@endforeach
									<tr class="subtotal">
										<td>Subtotal</td>
										<td class="sub-sale">
											<span></span>
											<input type="hidden" class="sub-sale-hidden" name="">
										</td>
										<td class="sub-cost">
											<span></span>
											<input type="hidden" class="sub-cost-hidden" name="">
										</td>
										<td class="sub-profit">
											<span></span>
											<input type="hidden" class="sub-profit-hidden" name="">
										</td>
										<td class="sub-profit-rate">
											<span></span>
											<input type="hidden" class="sub-rate-hidden" name="">
										</td>
										<td><input type="text" name="" class="sub-setting-rate-box"> %</td>
									</tr>
								</tbody>
							</table>
							<hr>
						</div>

						<div class="indi-area">
							<div class="area-heading">
								<h2>
									AREA EAST
								</h2>
							</div>
							<table class="scroll">
								<thead>
									<tr>
										<th style="background: transparent; padding-left: 30px;"></th>
										<th style="background: #e74c3c; padding-left: 30px;" colspan="5">予算</th>
										<th style="background: #2ecc71; padding-left: 30px;" colspan="4">予測</th>
										<th style="background: #3498db; padding-left: 30px;" colspan="5">進捗</th>
										<th style="background: #f1c40f; padding-left: 30px;" colspan="5">確定数値</th>
									</tr>
									<tr>
										<th>Location</th>
										<th>Sales</th>
										<th>Cost</th>
										<th>Profit</th>
										<th>Profit rate</th>
										<th>Setting rate</th>

										<th>Sales</th>
										<th>Cost</th>
										<th>Profit</th>
										<th>Profit rate</th>

										<th>Sales</th>
										<th>Cost</th>
										<th>Profit</th>
										<th>Profit rate</th>
										<th>Profit gap</th>

										<th>Sales</th>
										<th>Cost</th>
										<th>Profit</th>
										<th>Profit rate</th>
										<th>Profit gap</th>

									</tr>
								</thead>
								<tbody>
									@foreach ($area_east as $key)
									<tr class="record">
										<td>{{ $key->location_name }}
										<input type="hidden" name="area_east_location_{{ ++$k }}" value="{{ $key->location_name }}"></td>
										<td>
											<input type="text" value="" name="area_east_revenue_{{ $k }}" class="revenue-profit-input revenue">
										</td>
										<td>
											<input type="text" value="" name="area_east_cost_{{ $k }}" class="cost-profit-input cost">
										</td>
										<td class="profit">
											<span></span>
											<input type="hidden" class="hidden-profit" name="area_east_profit_{{ $k }}">
										</td>
										<td class="profit-rate">
											<span></span>
											<input type="hidden" class="hidden-profit-rate" name="area_east_profitRate_{{ $k }}">
										</td>
										<td>
											<input type="text" name="area_east_settingRate_{{ $k }}" class="setting-rate-box"> %
										</td>

										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											15%
										</td>

										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											15%
										</td>
										<td>
											&yen;400,000,00
										</td>

										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											&yen;3,000,000
										</td>
										<td>
											15%
										</td>
										<td>
											&yen;400,000,00
										</td>

									</tr>
									@endforeach
									<tr class="subtotal">
										<td>Subtotal</td>
										<td class="sub-sale">
											<span></span>
											<input type="hidden" class="sub-sale-hidden" name="">
										</td>
										<td class="sub-cost">
											<span></span>
											<input type="hidden" class="sub-cost-hidden" name="">
										</td>
										<td class="sub-profit">
											<span></span>
											<input type="hidden" class="sub-profit-hidden" name="">
										</td>
										<td class="sub-profit-rate">
											<span></span>
											<input type="hidden" class="sub-rate-hidden" name="">
										</td>
										<td><input type="text" name="" class="sub-setting-rate-box"> %</td>
									</tr>
								</tbody>
							</table>
							<hr>
						</div>

						<div class="gross_total">
							<table>
								<tbody>
									<tr>
										<td>Gross total</td>
										<td>&yen;78,000,000</td>
										<td>&yen;66,800,000</td>
										<td>&yen;11,200,000</td>
										<td>14.36%</td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="submit-row">
	            <button type="submit" class="btn-sumit">Done</button>
	          </div>
					</div>
					</form>
				</div>
			</div>
			@else
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
		                    <li><a href="/time_management">Time Management</a></li>
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
						<form action="budget-admin-date" method="POST">
							{{ csrf_field() }}
						<div style="margin-top: 20px">
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

							<label for="year">Year</label>
							<select id="year" name="year">
								<option value="" selected hidden></option>
								@php

									$curYear = Date("Y");
									for($i=2000; $i <= $curYear; $i++){
										echo "<option value='$i' id='$i'>$i</option>";
									}
								@endphp
							</select>
							<button type="submit" class="btn-sumit">Done</button>
						</div>
						</form>
						</br>
						<hr>
						<form action="budget-admin" method="POST">
							{{ csrf_field() }}
							<input type="hidden" name="month_a" id="month_a">
							<input type="hidden" name="year_a" id="year_a">
						<div class="tables-content">

							<div class="indi-area">
								<div class="area-heading">
									<h2>
										AREA WEST
									</h2>
								</div>
								<table class="scroll">
									<thead>
										<tr>
											<th style="background: transparent; padding-left: 30px;"></th>
											<th style="background: #e74c3c; padding-left: 30px;" colspan="5">予算</th>
											<th style="background: #2ecc71; padding-left: 30px;" colspan="4">予測</th>
											<th style="background: #3498db; padding-left: 30px;" colspan="5">進捗</th>
											<th style="background: #f1c40f; padding-left: 30px;" colspan="5">確定数値</th>
										</tr>
										<tr>
											<th>Location</th>
											<th>Sales</th>
											<th>Cost</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Setting rate</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Profit</th>
											<th>Profit rate</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Profit gap</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Profit gap</th>

										</tr>
									</thead>
									<tbody id="west">
										@foreach ($area_west_budget as $key)
										<tr class="record">
											<td>{{ $key->location_name }}
											<input type="hidden" name="area_west_location_{{ ++$j }}" value="{{ $key->location_name }}"></td>
											<td>
												<input type="text" value="{{ $key->revenue }}" name="area_west_revenue_{{ $j }}" class="revenue-profit-input revenue">
											</td>
											<td>
												<input type="text" value="{{ $key->cost }}" name="area_west_cost_{{ $j }}" class="cost-profit-input cost">
											</td>
											<td class="profit">
												<span>&yen;{{ $key->profit }}</span>
												<input type="hidden" value="{{ $key->profit }}" class="hidden-profit" name="area_west_profit_{{ $j }} ">
											</td>
											<td class="profit-rate">
												<span>{{ $key->profit_rate }}%</span>
												<input type="hidden" value="{{ $key->profit_rate }}" class="hidden-profit-rate" name="area_west_profitRate_{{ $j }}">
											</td>
											<td>
												<input type="text" value="{{ $key->setting_rate }}" name="area_west_settingRate_{{ $j }}" class="setting-rate-box"> %
											</td>

											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												15%
											</td>

											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												15%
											</td>
											<td>
												&yen;400,000,00
											</td>

											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												15%
											</td>
											<td>
												&yen;400,000,00
											</td>

										</tr>
										@endforeach
										<tr class="subtotal">
											<td>Subtotal</td>
											<td class="sub-sale">
												<span></span>
												<input type="hidden" class="sub-sale-hidden" name="">
											</td>
											<td class="sub-cost">
												<span></span>
												<input type="hidden" class="sub-cost-hidden" name="">
											</td>
											<td class="sub-profit">
												<span></span>
												<input type="hidden" class="sub-profit-hidden" name="">
											</td>
											<td class="sub-profit-rate">
												<span></span>
												<input type="hidden" class="sub-rate-hidden" name="">
											</td>
											<td><input type="text" name="" class="sub-setting-rate-box"> %</td>
										</tr>
									</tbody>
								</table>
								<hr>
							</div>

							<div class="indi-area">
								<div class="area-heading">
									<h2>
										AREA CENTRAL
									</h2>
								</div>
								<table class="scroll">
									<thead>
										<tr>
											<th style="background: transparent; padding-left: 30px;"></th>
											<th style="background: #e74c3c; padding-left: 30px;" colspan="5">予算</th>
											<th style="background: #2ecc71; padding-left: 30px;" colspan="4">予測</th>
											<th style="background: #3498db; padding-left: 30px;" colspan="5">進捗</th>
											<th style="background: #f1c40f; padding-left: 30px;" colspan="5">確定数値</th>
										</tr>
										<tr>
											<th>Location</th>
											<th>Sales</th>
											<th>Cost</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Setting rate</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Profit</th>
											<th>Profit rate</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Profit gap</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Profit gap</th>

										</tr>
									</thead>
									<tbody id="central">
										@foreach ($area_central_budget as $key)
										<tr class="record">
											<td>{{ $key->location_name }}
											<input type="hidden" name="area_central_location_{{ ++$l }}" value="{{ $key->location_name }}"></td>
											<td>
												<input type="text" value="{{ $key->revenue }}" name="area_central_revenue_{{ $l }}" class="revenue-profit-input revenue">
											</td>
											<td>
												<input type="text" value="{{ $key->cost }}" name="area_central_cost_{{ $l }}" class="cost-profit-input cost">
											</td>
											<td class="profit">
												<span>&yen;{{ $key->profit }}</span>
												<input type="hidden" value="{{ $key->profit }}" class="hidden-profit" name="area_central_profit_{{ $l }}">
											</td>
											<td class="profit-rate">
												<span>{{ $key->profit_rate }}%</span>
												<input type="hidden" value="{{ $key->profit_rate }}" class="hidden-profit-rate" name="area_central_profitRate_{{ $l }}">
											</td>
											<td>
												<input type="text" value="{{ $key->setting_rate }}" name="area_central_settingRate_{{ $l }}" class="setting-rate-box"> %
											</td>

											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												15%
											</td>

											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												15%
											</td>
											<td>
												&yen;400,000,00
											</td>

											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												15%
											</td>
											<td>
												&yen;400,000,00
											</td>

										</tr>
										@endforeach
										<tr class="subtotal">
											<td>Subtotal</td>
											<td class="sub-sale">
												<span></span>
												<input type="hidden" class="sub-sale-hidden" name="">
											</td>
											<td class="sub-cost">
												<span></span>
												<input type="hidden" class="sub-cost-hidden" name="">
											</td>
											<td class="sub-profit">
												<span></span>
												<input type="hidden" class="sub-profit-hidden" name="">
											</td>
											<td class="sub-profit-rate">
												<span></span>
												<input type="hidden" class="sub-rate-hidden" name="">
											</td>
											<td><input type="text" name="" class="sub-setting-rate-box"> %</td>
										</tr>
									</tbody>
								</table>
								<hr>
							</div>

							<div class="indi-area">
								<div class="area-heading">
									<h2>
										AREA EAST
									</h2>
								</div>
								<table class="scroll">
									<thead>
										<tr>
											<th style="background: transparent; padding-left: 30px;"></th>
											<th style="background: #e74c3c; padding-left: 30px;" colspan="5">予算</th>
											<th style="background: #2ecc71; padding-left: 30px;" colspan="4">予測</th>
											<th style="background: #3498db; padding-left: 30px;" colspan="5">進捗</th>
											<th style="background: #f1c40f; padding-left: 30px;" colspan="5">確定数値</th>
										</tr>
										<tr>
											<th>Location</th>
											<th>Sales</th>
											<th>Cost</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Setting rate</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Profit</th>
											<th>Profit rate</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Profit gap</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Profit gap</th>

										</tr>
									</thead>
									<tbody id="east">
										@foreach ($area_east_budget as $key)
										<tr class="record">
											<td>{{ $key->location_name }}
											<input type="hidden" name="area_east_location_{{ ++$k }}" value="{{ $key->location_name }}"></td>
											<td>
												<input type="text" value="{{ $key->revenue }}" name="area_east_revenue_{{ $k }}" class="revenue-profit-input revenue">
											</td>
											<td>
												<input type="text" value="{{ $key->cost }}" name="area_east_cost_{{ $k }}" class="cost-profit-input cost">
											</td>
											<td class="profit">
												<span>&yen;{{ $key->profit }}</span>
												<input type="hidden" value="{{ $key->profit }}" class="hidden-profit" name="area_east_profit_{{ $k }}">
											</td>
											<td class="profit-rate">
												<span>{{ $key->profit_rate }}%</span>
												<input type="hidden" value="{{ $key->profit_rate }}" class="hidden-profit-rate" name="area_east_profitRate_{{ $k }}">
											</td>
											<td>
												<input type="text" value="{{ $key->setting_rate }}" name="area_east_settingRate_{{ $k }}" class="setting-rate-box"> %
											</td>

											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												15%
											</td>

											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												15%
											</td>
											<td>
												&yen;400,000,00
											</td>

											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												&yen;3,000,000
											</td>
											<td>
												15%
											</td>
											<td>
												&yen;400,000,00
											</td>

										</tr>
										@endforeach
										<tr class="subtotal">
											<td>Subtotal</td>
											<td class="sub-sale">
												<span></span>
												<input type="hidden" class="sub-sale-hidden" name="">
											</td>
											<td class="sub-cost">
												<span></span>
												<input type="hidden" class="sub-cost-hidden" name="">
											</td>
											<td class="sub-profit">
												<span></span>
												<input type="hidden" class="sub-profit-hidden" name="">
											</td>
											<td class="sub-profit-rate">
												<span></span>
												<input type="hidden" class="sub-rate-hidden" name="">
											</td>
											<td><input type="text" name="" class="sub-setting-rate-box"> %</td>
										</tr>
									</tbody>
								</table>
								<hr>
							</div>

							<div class="gross_total">
								<table>
									<tbody>
										<tr>
											<td>Gross total</td>
											<td>&yen;78,000,000</td>
											<td>&yen;66,800,000</td>
											<td>&yen;11,200,000</td>
											<td>14.36%</td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="submit-row">
		            <button type="submit" class="btn-sumit">Done</button>
		          </div>
						</div>
						</form>
					</div>
				</div>

@endif





	</body>
</html>
