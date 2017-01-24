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
		<script src="sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="sweetalert.css">

		<!--[if lt IE 9]>
      	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    	<script type="text/javascript">

			$(document).ready(function() {
				var insert = @php
		  		echo $insert;
		  	@endphp;
		  	var update = @php
		  		echo $update;
		  	@endphp;
		  	if(insert==1)
		  	{
		  		swal("Done!", "Data have been inserted!", "success")
		  	}

		  	if(update==1)
		  	{
		  		swal("Done!", "Data have been updated!", "success")
		  	}

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

					var optionSelected = $("option:selected", $(this));
					var valueSelected = $(this).val();
					$('#month_a').val(valueSelected);
					});
					$('#year').on('change', function (e) {

					var optionSelected = $("option:selected", $(this));
					var valueSelected = $(this).val();
					$('#year_a').val(valueSelected);
				});

				$('#west .expense').each(function(){
		 			calcSubTotal($(this));
		 		});


		 		$('#central .expense').each(function(){
		 			calcSubTotal($(this));
		 		});

		 		$('#east .expense').each(function(){
		 			calcSubTotal($(this));
		 		});
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
			.sub-setting-rate-box,
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
		@if (empty($location_forecast_west[0]))
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
								<li><a href="kpi">L-KPI</a></li>
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
								<option value="1">JANUARY</option>
								<option value="2">FEBRAURY</option>
								<option value="3">MARCH</option>
								<option value="4">APRIL</option>
								<option value="5">MAY</option>
								<option value="6">JUNE</option>
								<option value="7">JULY</option>
								<option value="8">AUGUST</option>
								<option value="9">SEPTEMBER</option>
								<option value="10">OCTOBER</option>
								<option value="11">NOVEMBER</option>
								<option value="12">DECEMBER</option>
							</select>

							<label for="year">Year</label>
							<select id="year" name="year">
								<option value="" selected hidden></option>
								@php

									$curYear = Date("Y");
									for($i=1990; $i <= $curYear; $i++){
										echo "<option value='$i'>$i</option>";
									}
								@endphp
							</select>
							<button type="submit" class="btn-sumit">Done</button>
						</div>
					</form>
					</br>
					<hr>
					<form action="budget-manager" method="POST">
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
											<th style="background: #2ecc71; padding-left: 30px;" colspan="5">予測</th>
											<th style="background: #3498db; padding-left: 30px;" colspan="6">進捗</th>
											<th style="background: #f1c40f; padding-left: 30px;" colspan="6">確定数値</th>
										</tr>
										<tr>
											<th>Location</th>
											<th>Sales</th>
											<th>Cost</th>
											<th>Expense</th>
											<th>Profit</th>
											<th>Profit rate</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Expense</th>
											<th>Profit</th>
											<th>Profit rate</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Expense</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Profit gap</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Expense</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Profit gap</th>

										</tr>
									</thead>
									<tbody id="west">
									@foreach ($area_west as $key)
										{{ ++$l }}
										<tr class="record">
											<td>
												{{ $key->location_name }}
												<input type="hidden" name="location_west_{{ $l }}" value="{{ $key->location_name }}">
											</td>
											@if (empty($area_west_budget[0]))
	 										 <td class="company-sale">
	   										 &yen;
	   									 </td>
	   									 <td class="company-cost">
	   										 &yen;
	   									 </td>
	   									 <td class="company-expense">&yen;</td>
	   									 <td class="company-profit">
	   										 <span>&yen;</span>
	   										 <input type="hidden" class="company hidden-profit" value="1600" name="budget_west_profit_{{ $l }}">
	   									 </td>
	   									 <td class="company-profit-rate">%</td>
	 										 @else
	 											 <td class="company-sale">
	 												 &yen;{{ $area_west_budget[$l-1]->revenue }}
	 											 </td>
	 											 <td class="company-cost">
	 												 &yen;{{ $area_west_budget[$l-1]->cost }}
	 											 </td>
	 											 <td class="company-expense">&yen;{{ $area_west_budget[$l-1]->headoffice_expense }}</td>
	 											 <td class="company-profit">
	 												 <span>&yen;{{ $area_west_budget[$l-1]->profit }}</span>
	 												 <input type="hidden" class="company hidden-profit" value="1600" name="budget_west_profit_{{ $l }}">
	 											 </td>
	 											 <td class="company-profit-rate">{{ $area_west_budget[$l-1]->profit_rate }}%</td>
	 									 @endif

											<td class="forecast-sale">
												<input type="text" value="" name="forecast_west_revenue_{{ $l }}" class="forecast revenue">
											</td>
											<td class="forecast-cost">
												<input type="text" value="" name="forecast_west_cost_{{ $l }}" class="forecast cost">
											</td>
											@if (empty($area_west_budget[0]))
	 										 <td class="forecast-expense">
	   										 <span>&yen;</span>
	   										 <input type="hidden" value="" class="forecast expense" name="forecast_west_expense_{{ $l }}">
	   									 </td>
	 									 @else
	 										 <td class="forecast-expense">
	 											 <span>&yen;{{ $area_west_budget[$l-1]->headoffice_expense }}</span>
	 											 <input type="hidden" value="{{ $area_west_budget[$l-1]->headoffice_expense }}" class="forecast expense" name="forecast_west_expense_{{ $l }}">
	 										 </td>
	 									 @endif
											<td class="forecast-profit">
												<span>&yen;</span>
												<input type="hidden" value="" class="forecast hidden-profit" name="forecast_west_profit_{{ $l }}">
											</td>
											<td class="forecast-profit-rate">
												<span>%</span>
												<input type="hidden" class="forecast hidden-profit-rate" name="forecast_west_profitRate_{{ $l }}">
											</td>

											<td>&yen;</td>
											<td>
												&yen;
											</td>
											<td>
												&yen;
											</td>
											<td>
												&yen;
											</td>
											<td>
												%
											</td>
											<td>
												%
											</td>

											<td>
												<input type="text" value="" name="final_west_revenue_{{ $l }}" class="revenue-profit-input final revenue">
											</td>
											<td>
												<input type="text" value="" name="final_west_cost_{{ $l }}" class="cost-profit-input final cost">
											</td>
											@if (empty($location_final_west[0]))
												<td class="final-expense">
													<span>&yen;</span>
													<input type="hidden" value="" name="final_west_expense_{{ $l }}" class="expense-input final expense">
												</td>
											@else
												<td class="final-expense">
													<span>&yen;{{ $location_final_west[$l-1]->headoffice_expense }}</span>
													<input type="hidden" value="{{ $location_final_west[$l-1]->headoffice_expense }}" name="final_west_expense_{{ $l }}" class="expense-input final expense">
												</td>
											@endif

											<td class="final-profit">
												<span>&yen;</span>
												<input type="hidden" class="final hidden-profit" name="final_west_profit_{{ $l }}">
											</td>
											<td class="final-profit-rate">
												<span>%</span>
												<input type="hidden" class="final hidden-profit-rate" name="final_west_profitRate_{{ $l }}">
											</td>
											<td class="final-profit-gap">
												<span>&yen;</span>
												<input type="hidden" class="final hidden-profit-gap" name="final_west_profitGap_{{ $l }}">
											</td>

										</tr>
									@endforeach
										<tr class="subtotal">
											<td>Subtotal</td>
											<td>&yen;</td>
											<td>&yen;</td>
											<td>&yen;</td>
											<td>%</td>
											<td>%</td>

											<td class="forecast-sub-sale">
												<span>&yen;</span>
												<input type="hidden" class="forecast sub-sale-hidden" name="forecast_west_sub_sale">
											</td>
											<td class="forecast-sub-cost">
												<span>&yen;</span>
												<input type="hidden" class="forecast sub-cost-hidden" name="forecast_west_sub_cost">
											</td>
											<td class="forecast-sub-expense">
												<span>&yen;</span>
												<input type="hidden" class="forecast sub-expense-hidden" name="forecast_west_sub_expense">
											</td>
											<td class="forecast-sub-profit">
												<span>&yen;</span>
												<input type="hidden" class="forecast sub-profit-hidden" name="forecast_west_sub_profit">
											</td>
											<td class="forecast-sub-profit-rate">
												<span>%</span>
												<input type="hidden" class="forecast sub-rate-hidden" name="forecast_west_sub_profit_rate">
											</td>

											<td>

											</td>
											<td>

											</td>
											<td>

											</td>
											<td>

											</td>
											<td>

											</td>
											<td>

											</td>

											<td class="final-sub-sale">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-sale-hidden" name="final_west_sub_sale">
											</td>
											<td class="final-sub-cost">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-cost-hidden" name="final_west_sub_cost">
											</td>
											<td class="final-sub-expense">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-expense-hidden" name="final_west_sub_expense">
											</td>
											<td class="final-sub-profit">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-profit-hidden" name="final_west_sub_profit">
											</td>
											<td class="final-sub-profit-rate">
												<span>%</span>
												<input type="hidden" value="" class="final sub-rate-hidden" name="final_west_sub_profit_rate">
											</td>
											<td class="final-sub-profit-gap">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-profitgap-hidden" name="final_west_sub_profitgap">
											</td>
										</tr>
									</tbody>
								</table>
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
											<th style="background: #2ecc71; padding-left: 30px;" colspan="5">予測</th>
											<th style="background: #3498db; padding-left: 30px;" colspan="6">進捗</th>
											<th style="background: #f1c40f; padding-left: 30px;" colspan="6">確定数値</th>
										</tr>
										<tr>
											<th>Location</th>
											<th>Sales</th>
											<th>Cost</th>
											<th>Expense</th>
											<th>Profit</th>
											<th>Profit rate</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Expense</th>
											<th>Profit</th>
											<th>Profit rate</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Expense</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Profit gap</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Expense</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Profit gap</th>

										</tr>
									</thead>
									<tbody id="central">
									@foreach ($area_central as $key)
										{{ ++$k }}
										<tr class="record">
											<td>
												{{ $key->location_name }}
												<input type="hidden" name="location_central_{{ $k }}" value="{{ $key->location_name }}">
											</td>
											@if (empty($area_central_budget[0]))
	 										 <td>
	   										 &yen;
	   									 </td>
	   									 <td>
	   										 &yen;
	   									 </td>
	   									 <td>&yen;</td>
	   									 <td class="company-profit">
	   										 <span>&yen;</span>
	   										 <input type="hidden" class="hidden-profit" value="1600" name="budget_central_profit{{ $k }}">
	   									 </td>
	   									 <td>%</td>
	 									 @else
	 										 <td>
	 											 &yen;{{ $area_central_budget[$k-1]->revenue }}
	 										 </td>
	 										 <td>
	 											 &yen;{{ $area_central_budget[$k-1]->cost }}
	 										 </td>
	 										 <td>&yen;{{ $area_central_budget[$k-1]->headoffice_expense }}</td>
	 										 <td class="company-profit">
	 											 <span>&yen;{{ $area_central_budget[$k-1]->profit }}</span>
	 											 <input type="hidden" class="hidden-profit" value="1600" name="budget_central_profit{{ $k }}">
	 										 </td>
	 										 <td>{{ $area_central_budget[$k-1]->profit_rate }}%</td>
	 									 @endif

											<td>
												<input type="text" value="" name="forecast_central_revenue_{{ $k }}" class="forecast revenue">
											</td>
											<td>
												<input type="text" value="" name="forecast_central_cost_{{ $k }}" class="forecast cost">
											</td>
											@if (empty($area_central_budget[0]))
	 										 <td class="forecast-expense">
	   										 <span>&yen;</span>
	   										 <input type="hidden" value="" class="forecast expense" name="forecast_central_expense_{{ $k }}">
	   									 </td>
	 									 @else
	 										 <td class="forecast-expense">
	 										 <span>&yen;{{ $area_central_budget[$k-1]->headoffice_expense }}</span>
	 										 <input type="hidden" value="{{ $area_central_budget[$k-1]->headoffice_expense }}" class="forecast expense" name="forecast_central_expense_{{ $k }}">
	 									 </td>
	 									 @endif
											<td class="forecast-profit">
												<span>&yen;</span>
												<input type="hidden" value="" class="forecast hidden-profit" name="forecast_central_profit_{{ $k }}">
											</td>
											<td class="forecast-profit-rate">
												<span>%</span>
												<input type="hidden" class="forecast hidden-profit-rate" name="forecast_central_profitRate_{{ $k }}">
											</td>

											<td>&yen;</td>
											<td>
												&yen;
											</td>
											<td>
												&yen;
											</td>
											<td>
												&yen;
											</td>
											<td>
												%
											</td>
											<td>
												%
											</td>

											<td>
												<input type="text" value="" name="final_central_revenue_{{ $k }}" class="revenue-profit-input final revenue">
											</td>
											<td>
												<input type="text" value="" name="final_central_cost_{{ $k }}" class="cost-profit-input final cost">
											</td>
											@if (empty($location_final_central[0]))
	 										 <td class="final-expense">
	 											 <span>&yen;</span>
	 											 <input type="hidden" value="" name="final_central_expense_{{ $k }}" class="expense-input final expense">
	 										 </td>
	 									 @else
	 										 <td class="final-expense">
	 											 <span>&yen;{{ $location_final_central[$k-1]->headoffice_expense }}</span>
	 											 <input type="hidden" value="{{ $location_final_central[$k-1]->headoffice_expense }}" name="final_central_expense_{{ $k }}" class="expense-input final expense">
	 										 </td>
	 									 @endif
											<td class="final-profit">
												<span>&yen;</span>
												<input type="hidden" class="final hidden-profit" name="final_central_profit_{{ $k }}">
											</td>
											<td class="final-profit-rate">
												<span>%</span>
												<input type="hidden" class="final hidden-profit-rate" name="final_central_profitRate_{{ $k }}">
											</td>
											<td class="final-profit-gap">
												<span>&yen;</span>
												<input type="hidden" class="final hidden-profit-gap" name="final_central_profitGap_{{ $k }}">
											</td>

										</tr>
									@endforeach
										<tr class="subtotal">
											<td>Subtotal</td>
											<td>&yen;</td>
											<td>&yen;</td>
											<td>&yen;</td>
											<td>%</td>
											<td>%</td>

											<td class="forecast-sub-sale">
												<span>&yen;</span>
												<input type="hidden" class="forecast sub-sale-hidden" name="forecast_central_sub_sale">
											</td>
											<td class="forecast-sub-cost">
												<span>&yen;</span>
												<input type="hidden" class="forecast sub-cost-hidden" name="forecast_central_sub_cost">
											</td>
											<td class="forecast-sub-expense">
												<span>&yen;</span>
												<input type="hidden" class="forecast sub-expense-hidden" name="forecast_central_sub_expense">
											</td>
											<td class="forecast-sub-profit">
												<span>&yen;</span>
												<input type="hidden" class="forecast sub-profit-hidden" name="forecast_central_sub_profit">
											</td>
											<td class="forecast-sub-profit-rate">
												<span>%</span>
												<input type="hidden" class="forecast sub-rate-hidden" name="forecast_central_sub_profit_rate">
											</td>

											<td>

											</td>
											<td>

											</td>
											<td>

											</td>
											<td>

											</td>
											<td>

											</td>
											<td>

											</td>

											<td class="final-sub-sale">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-sale-hidden" name="final_central_sub_sale">
											</td>
											<td class="final-sub-cost">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-cost-hidden" name="final_central_sub_cost">
											</td>
											<td class="final-sub-expense">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-expense-hidden" name="final_central_sub_expense">
											</td>
											<td class="final-sub-profit">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-profit-hidden" name="final_central_sub_profit">
											</td>
											<td class="final-sub-profit-rate">
												<span>%</span>
												<input type="hidden" value="" class="final sub-rate-hidden" name="final_central_sub_profit_rate">
											</td>
											<td class="final-sub-profit-gap">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-profitgap-hidden" name="final_central_sub_profitgap">
											</td>
										</tr>
									</tbody>
								</table>
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
											<th style="background: #2ecc71; padding-left: 30px;" colspan="5">予測</th>
											<th style="background: #3498db; padding-left: 30px;" colspan="6">進捗</th>
											<th style="background: #f1c40f; padding-left: 30px;" colspan="6">確定数値</th>
										</tr>
										<tr>
											<th>Location</th>
											<th>Sales</th>
											<th>Cost</th>
											<th>Expense</th>
											<th>Profit</th>
											<th>Profit rate</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Expense</th>
											<th>Profit</th>
											<th>Profit rate</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Expense</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Profit gap</th>

											<th>Sales</th>
											<th>Cost</th>
											<th>Expense</th>
											<th>Profit</th>
											<th>Profit rate</th>
											<th>Profit gap</th>

										</tr>
									</thead>
									<tbody id="east">
									@foreach ($area_east as $key)
										{{ ++$j }}
										<tr class="record">
											<td>
												{{ $key->location_name }}
												<input type="hidden" name="location_east_{{ $j }}" value="{{ $key->location_name }}">
											</td>
											@if (empty($area_east_budget[0]))
	 										 <td>
	 											 &yen;
	 										 </td>
	 										 <td>
	 											 &yen;
	 										 </td>
	 										 <td>&yen;</td>
	 										 <td class="company-profit">
	 											 <span>&yen;</span>
	 											 <input type="hidden" class="hidden-profit" value="1600" name="budget_east_profit{{ $j }}">
	 										 </td>
	 										 <td>%</td>
	 									 	@else
	 											<td>
	 	 										 &yen;{{ $area_east_budget[$j-1]->revenue }}
	 	 									 </td>
	 	 									 <td>
	 	 										 &yen;{{ $area_east_budget[$j-1]->cost }}
	 	 									 </td>
	 	 									 <td>&yen;{{ $area_east_budget[$j-1]->headoffice_expense }}</td>
	 	 									 <td class="company-profit">
	 	 										 <span>&yen;{{ $area_east_budget[$j-1]->profit }}</span>
	 	 										 <input type="hidden" class="hidden-profit" value="1600" name="budget_east_profit{{ $j }}">
	 	 									 </td>
	 	 									 <td>{{ $area_east_budget[$j-1]->profit_rate }}%</td>
	 									 @endif

											<td>
												<input type="text" value="" name="forecast_east_revenue_{{ $j }}" class="forecast revenue">
											</td>
											<td>
												<input type="text" value="" name="forecast_east_cost_{{ $j }}" class="forecast cost">
											</td>
											@if (empty($area_east_budget[0]))
	 										 <td class="forecast-expense">
	   										 <span>&yen;</span>
	   										 <input type="hidden" value="" class="forecast expense" name="forecast_east_expense_{{ $j }}">
	   									 </td>
	 									 @else
	 										 <td class="forecast-expense">
	 											 <span>&yen;{{ $area_east_budget[$j-1]->headoffice_expense }}</span>
	 											 <input type="hidden" value="{{ $area_east_budget[$j-1]->headoffice_expense }}" class="forecast expense" name="forecast_east_expense_{{ $j }}">
	 										 </td>
	 									 @endif
											<td class="forecast-profit">
												<span>&yen;</span>
												<input type="hidden" value="" class="forecast hidden-profit" name="forecast_east_profit_{{ $j }}">
											</td>
											<td class="forecast-profit-rate">
												<span>%</span>
												<input type="hidden" class="forecast hidden-profit-rate" name="forecast_east_profitRate_{{ $j }}">
											</td>

											<td>&yen;</td>
											<td>
												&yen;
											</td>
											<td>
												&yen;
											</td>
											<td>
												&yen;
											</td>
											<td>
												15%
											</td>
											<td>
												13%
											</td>

											<td>
												<input type="text" value="" name="final_east_revenue_{{ $j }}" class="revenue-profit-input final revenue">
											</td>
											<td>
												<input type="text" value="" name="final_east_cost_{{ $j }}" class="cost-profit-input final cost">
											</td>
											@if (empty($location_final_east[0]))
	 										 <td class="final-expense">
	 											 <span>&yen;</span>
	 											 <input type="hidden" value="" name="final_east_expense_{{ $j }}" class="expense-input final expense">
	 										 </td>
	 									 @else
	 										 <td class="final-expense">
	 											 <span>&yen;{{ $location_final_east[$j-1]->headoffice_expense }}</span>
	 											 <input type="hidden" value="{{ $location_final_east[$j-1]->headoffice_expense }}" name="final_east_expense_{{ $j }}" class="expense-input final expense">
	 										 </td>
	 									 @endif
											<td class="final-profit">
												<span>&yen;</span>
												<input type="hidden" class="final hidden-profit" name="final_east_profit_{{ $j }}">
											</td>
											<td class="final-profit-rate">
												<span>%</span>
												<input type="hidden" class="final hidden-profit-rate" name="final_east_profitRate_{{ $j }}">
											</td>
											<td class="final-profit-gap">
												<span>&yen;</span>
												<input type="hidden" class="final hidden-profit-gap" name="final_east_profitGap_{{ $j }}">
											</td>

										</tr>
									@endforeach
										<tr class="subtotal">
											<td>Subtotal</td>
											<td>&yen;</td>
											<td>&yen;</td>
											<td>&yen;</td>
											<td>%</td>
											<td>%</td>

											<td class="forecast-sub-sale">
												<span>&yen;</span>
												<input type="hidden" class="forecast sub-sale-hidden" name="forecast_east_sub_sale">
											</td>
											<td class="forecast-sub-cost">
												<span>&yen;</span>
												<input type="hidden" class="forecast sub-cost-hidden" name="forecast_east_sub_cost">
											</td>
											<td class="forecast-sub-expense">
												<span>&yen;</span>
												<input type="hidden" class="forecast sub-expense-hidden" name="forecast_east_sub_expense">
											</td>
											<td class="forecast-sub-profit">
												<span>&yen;</span>
												<input type="hidden" class="forecast sub-profit-hidden" name="forecast_east_sub_profit">
											</td>
											<td class="forecast-sub-profit-rate">
												<span>%</span>
												<input type="hidden" class="forecast sub-rate-hidden" name="forecast_east_sub_profit_rate">
											</td>

											<td>

											</td>
											<td>

											</td>
											<td>

											</td>
											<td>

											</td>
											<td>

											</td>
											<td>

											</td>

											<td class="final-sub-sale">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-sale-hidden" name="final_east_sub_sale">
											</td>
											<td class="final-sub-cost">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-cost-hidden" name="final_east_sub_cost">
											</td>
											<td class="final-sub-expense">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-expense-hidden" name="final_east_sub_expense">
											</td>
											<td class="final-sub-profit">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-profit-hidden" name="final_east_sub_profit">
											</td>
											<td class="final-sub-profit-rate">
												<span>%</span>
												<input type="hidden" value="" class="final sub-rate-hidden" name="final_east_sub_profit_rate">
											</td>
											<td class="final-sub-profit-gap">
												<span>&yen;</span>
												<input type="hidden" value="" class="final sub-profitgap-hidden" name="final_east_sub_profitgap">
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="gross_total">
								<table>
									<thead>
			  							<tr>
			  								<th></th>
			  								<th>Sale</th>
			  								<th>Cost</th>
			  								<th>Expense</th>
			  								<th>Profit</th>
			  								<th>Profit Rate</th>

			  							</tr>
		  							</thead>
			  						<tbody>
											@if (empty($gross[0]))
												<tr>
				  								<td>Gross total</td>
				  								<td>
				  									<!-- Gross sale -->
				  								</td>
				  								<td>
				  									<!-- Gross cost -->
				  								</td>
				  								<td>
				  									<!-- Gross expense -->
				  								</td>
				  								<td>
				  									<!-- Gross profit -->
				  								</td>
				  								<td>
				  									<!-- Gross profit rate -->
				  								</td>

				  							</tr>
											@else
												<tr>
				  								<td>Gross total</td>
				  								<td>
														&yen;{{ $gross[0]->revenue }}
				  									<!-- Gross sale -->
				  								</td>
				  								<td>
														&yen;{{ $gross[0]->cost }}
				  									<!-- Gross cost -->
				  								</td>
				  								<td>
														&yen;{{ $gross[0]->headoffice_expense }}
				  									<!-- Gross expense -->
				  								</td>
				  								<td>
														&yen;{{ $gross[0]->profit }}
				  									<!-- Gross profit -->
				  								</td>
				  								<td>
														{{ $gross[0]->profit }}%
				  									<!-- Gross profit rate -->
				  								</td>

				  							</tr>
											@endif

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
						 <li><a href="kpi">L-KPI</a></li>
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
						 <option value="1">JANUARY</option>
						 <option value="2">FEBRAURY</option>
						 <option value="3">MARCH</option>
						 <option value="4">APRIL</option>
						 <option value="5">MAY</option>
						 <option value="6">JUNE</option>
						 <option value="7">JULY</option>
						 <option value="8">AUGUST</option>
						 <option value="9">SEPTEMBER</option>
						 <option value="10">OCTOBER</option>
						 <option value="11">NOVEMBER</option>
						 <option value="12">DECEMBER</option>
					 </select>

					 <label for="year">Year</label>
					 <select id="year" name="year">
						 <option value="" selected hidden></option>
						 @php

							 $curYear = Date("Y");
							 for($i=1990; $i <= $curYear; $i++){
								 echo "<option value='$i'>$i</option>";
							 }
						 @endphp
					 </select>
					 <button type="submit" class="btn-sumit">Done</button>
				 </div>
			 </form>
			 </br>
			 <hr>
			 <form action="budget-manager" method="POST">
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
									 <th style="background: #2ecc71; padding-left: 30px;" colspan="5">予測</th>
									 <th style="background: #3498db; padding-left: 30px;" colspan="6">進捗</th>
									 <th style="background: #f1c40f; padding-left: 30px;" colspan="6">確定数値</th>
								 </tr>
								 <tr>
									 <th>Location</th>
									 <th>Sales</th>
									 <th>Cost</th>
									 <th>Expense</th>
									 <th>Profit</th>
									 <th>Profit rate</th>

									 <th>Sales</th>
									 <th>Cost</th>
									 <th>Expense</th>
									 <th>Profit</th>
									 <th>Profit rate</th>

									 <th>Sales</th>
									 <th>Cost</th>
									 <th>Expense</th>
									 <th>Profit</th>
									 <th>Profit rate</th>
									 <th>Profit gap</th>

									 <th>Sales</th>
									 <th>Cost</th>
									 <th>Expense</th>
									 <th>Profit</th>
									 <th>Profit rate</th>
									 <th>Profit gap</th>

								 </tr>
							 </thead>
							 <tbody id="west">
							 @foreach ($location_forecast_west as $key)
								 {{ ++$l }}
								 <tr class="record">
									 <td>
										 {{ $key->location_name }}
										 <input type="hidden" name="location_west_{{ $l }}" value="{{ $key->location_name }}">
									 </td>
									 @if (empty($area_west_budget[0]))
										 <td class="company-sale">
  										 &yen;
  									 </td>
  									 <td class="company-cost">
  										 &yen;
  									 </td>
  									 <td class="company-expense">&yen;</td>
  									 <td class="company-profit">
  										 <span>&yen;</span>
  										 <input type="hidden" class="company hidden-profit" value="1600" name="budget_west_profit_{{ $l }}">
  									 </td>
  									 <td class="company-profit-rate">%</td>
										 @else
											 <td class="company-sale">
												 &yen;{{ $area_west_budget[$l-1]->revenue }}
											 </td>
											 <td class="company-cost">
												 &yen;{{ $area_west_budget[$l-1]->cost }}
											 </td>
											 <td class="company-expense">&yen;{{ $area_west_budget[$l-1]->headoffice_expense }}</td>
											 <td class="company-profit">
												 <span>&yen;{{ $area_west_budget[$l-1]->profit }}</span>
												 <input type="hidden" class="company hidden-profit" value="1600" name="budget_west_profit_{{ $l }}">
											 </td>
											 <td class="company-profit-rate">{{ $area_west_budget[$l-1]->profit_rate }}%</td>
									 @endif


									 <td class="forecast-sale">
										 <input type="text" value="{{ $key->revenue }}" name="forecast_west_revenue_{{ $l }}" class="forecast revenue">
									 </td>
									 <td class="forecast-cost">
										 <input type="text" value="{{ $key->cost }}" name="forecast_west_cost_{{ $l }}" class="forecast cost">
									 </td>
									 @if (empty($area_west_budget[0]))
										 <td class="forecast-expense">
  										 <span>&yen;</span>
  										 <input type="hidden" value="" class="forecast expense" name="forecast_west_expense_{{ $l }}">
  									 </td>
									 @else
										 <td class="forecast-expense">
											 <span>&yen;{{ $area_west_budget[$l-1]->headoffice_expense }}</span>
											 <input type="hidden" value="{{ $area_west_budget[$l-1]->headoffice_expense }}" class="forecast expense" name="forecast_west_expense_{{ $l }}">
										 </td>
									 @endif

									 <td class="forecast-profit">
										 <span>&yen;{{ $key->profit }}</span>
										 <input type="hidden" value="{{ $key->profit }}" class="forecast hidden-profit" name="forecast_west_profit_{{ $l }}">
									 </td>
									 <td class="forecast-profit-rate">
										 <span>%{{ $key->profit_rate }}</span>
										 <input type="hidden" value="{{ $key->profit_rate }}" class="forecast hidden-profit-rate" name="forecast_west_profitRate_{{ $l }}">
									 </td>

									 <td>&yen;</td>
									 <td>
										 &yen;
									 </td>
									 <td>
										 &yen;
									 </td>
									 <td>
										 &yen;
									 </td>
									 <td>
										 %
									 </td>
									 <td>
										 %
									 </td>

									 <td>
										 <input type="text" value="{{ $location_final_west[$l-1]->revenue }}" name="final_west_revenue_{{ $l }}" class="revenue-profit-input final revenue">
									 </td>
									 <td>
										 <input type="text" value="{{ $location_final_west[$l-1]->cost }}" name="final_west_cost_{{ $l }}" class="cost-profit-input final cost">
									 </td>
									 @if (empty($location_final_west[0]))
										 <td class="final-expense">
											 <span>&yen;</span>
											 <input type="hidden" value="" name="final_west_expense_{{ $l }}" class="expense-input final expense">
										 </td>
									 @else
										 <td class="final-expense">
											 <span>&yen;{{ $location_final_west[$l-1]->headoffice_expense }}</span>
											 <input type="hidden" value="" name="final_west_expense_{{ $l }}" class="expense-input final expense">
										 </td>
									 @endif

									 <td class="final-profit">
										 <span>&yen;{{ $location_final_west[$l-1]->profit }}</span>
										 <input type="hidden" value="{{ $location_final_west[$l-1]->profit }}" class="final hidden-profit" name="final_west_profit_{{ $l }}">
									 </td>
									 <td class="final-profit-rate">
										 <span>%{{ $location_final_west[$l-1]->profit_rate }}</span>
										 <input type="hidden" value="{{ $location_final_west[$l-1]->profit_rate }}"class="final hidden-profit-rate" name="final_west_profitRate_{{ $l }}">
									 </td>
									 <td class="final-profit-gap">
										 <span>&yen;</span>
										 <input type="hidden" class="final hidden-profit-gap" name="final_west_profitGap_{{ $l }}">
									 </td>

								 </tr>
							 @endforeach
								 <tr class="subtotal">
									 <td>Subtotal</td>
									 <td>&yen;</td>
									 <td>&yen;</td>
									 <td>&yen;</td>
									 <td>%</td>
									 <td>%</td>

									 <td class="forecast-sub-sale">
										 <span>&yen;</span>
										 <input type="hidden" class="forecast sub-sale-hidden" name="forecast_west_sub_sale">
									 </td>
									 <td class="forecast-sub-cost">
										 <span>&yen;</span>
										 <input type="hidden" class="forecast sub-cost-hidden" name="forecast_west_sub_cost">
									 </td>
									 <td class="forecast-sub-expense">
										 <span>&yen;</span>
										 <input type="hidden" class="forecast sub-expense-hidden" name="forecast_west_sub_expense">
									 </td>
									 <td class="forecast-sub-profit">
										 <span>&yen;</span>
										 <input type="hidden" class="forecast sub-profit-hidden" name="forecast_west_sub_profit">
									 </td>
									 <td class="forecast-sub-profit-rate">
										 <span>%</span>
										 <input type="hidden" class="forecast sub-rate-hidden" name="forecast_west_sub_profit_rate">
									 </td>

									 <td>

									 </td>
									 <td>

									 </td>
									 <td>

									 </td>
									 <td>

									 </td>
									 <td>

									 </td>
									 <td>

									 </td>

									 <td class="final-sub-sale">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-sale-hidden" name="final_west_sub_sale">
									 </td>
									 <td class="final-sub-cost">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-cost-hidden" name="final_west_sub_cost">
									 </td>
									 <td class="final-sub-expense">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-expense-hidden" name="final_west_sub_expense">
									 </td>
									 <td class="final-sub-profit">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-profit-hidden" name="final_west_sub_profit">
									 </td>
									 <td class="final-sub-profit-rate">
										 <span>%</span>
										 <input type="hidden" value="" class="final sub-rate-hidden" name="final_west_sub_profit_rate">
									 </td>
									 <td class="final-sub-profit-gap">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-profitgap-hidden" name="final_west_sub_profitgap">
									 </td>
								 </tr>
							 </tbody>
						 </table>
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
									 <th style="background: #2ecc71; padding-left: 30px;" colspan="5">予測</th>
									 <th style="background: #3498db; padding-left: 30px;" colspan="6">進捗</th>
									 <th style="background: #f1c40f; padding-left: 30px;" colspan="6">確定数値</th>
								 </tr>
								 <tr>
									 <th>Location</th>
									 <th>Sales</th>
									 <th>Cost</th>
									 <th>Expense</th>
									 <th>Profit</th>
									 <th>Profit rate</th>

									 <th>Sales</th>
									 <th>Cost</th>
									 <th>Expense</th>
									 <th>Profit</th>
									 <th>Profit rate</th>

									 <th>Sales</th>
									 <th>Cost</th>
									 <th>Expense</th>
									 <th>Profit</th>
									 <th>Profit rate</th>
									 <th>Profit gap</th>

									 <th>Sales</th>
									 <th>Cost</th>
									 <th>Expense</th>
									 <th>Profit</th>
									 <th>Profit rate</th>
									 <th>Profit gap</th>

								 </tr>
							 </thead>
							 <tbody id="central">
							 @foreach ($location_forecast_central as $key)
								 {{ ++$k }}
								 <tr class="record">
									 <td>
										 {{ $key->location_name }}
										 <input type="hidden" name="location_central_{{ $k }}" value="{{ $key->location_name }}">
									 </td>
									 @if (empty($area_central_budget[0]))
										 <td>
  										 &yen;
  									 </td>
  									 <td>
  										 &yen;
  									 </td>
  									 <td>&yen;</td>
  									 <td class="company-profit">
  										 <span>&yen;</span>
  										 <input type="hidden" class="hidden-profit" value="1600" name="budget_central_profit{{ $k }}">
  									 </td>
  									 <td>%</td>
									 @else
										 <td>
											 &yen;{{ $area_central_budget[$k-1]->revenue }}
										 </td>
										 <td>
											 &yen;{{ $area_central_budget[$k-1]->cost }}
										 </td>
										 <td>&yen;{{ $area_central_budget[$k-1]->headoffice_expense }}</td>
										 <td class="company-profit">
											 <span>&yen;{{ $area_central_budget[$k-1]->profit }}</span>
											 <input type="hidden" class="hidden-profit" value="1600" name="budget_central_profit{{ $k }}">
										 </td>
										 <td>{{ $area_central_budget[$k-1]->profit_rate }}%</td>
									 @endif
									 <td>
										 <input type="text" value="{{ $key->revenue }}" name="forecast_central_revenue_{{ $k }}" class="forecast revenue">
									 </td>
									 <td>
										 <input type="text" value="{{ $key->cost }}" name="forecast_central_cost_{{ $k }}" class="forecast cost">
									 </td>
									 @if (empty($area_central_budget[0]))
										 <td class="forecast-expense">
  										 <span>&yen;</span>
  										 <input type="hidden" value="" class="forecast expense" name="forecast_central_expense_{{ $k }}">
  									 </td>
									 @else
										 <td class="forecast-expense">
										 <span>&yen;{{ $area_central_budget[$k-1]->headoffice_expense }}</span>
										 <input type="hidden" value="{{ $area_central_budget[$k-1]->headoffice_expense }}" class="forecast expense" name="forecast_central_expense_{{ $k }}">
									 </td>
									 @endif

									 <td class="forecast-profit">
										 <span>&yen;{{ $key->profit }}</span>
										 <input type="hidden" value="{{ $key->profit }}" class="forecast hidden-profit" name="forecast_central_profit_{{ $k }}">
									 </td>
									 <td class="forecast-profit-rate">
										 <span>%{{ $key->profit }}</span>
										 <input type="hidden" value="{{ $key->profit_rate }}" class="forecast hidden-profit-rate" name="forecast_central_profitRate_{{ $k }}">
									 </td>

									 <td>&yen;</td>
									 <td>
										 &yen;
									 </td>
									 <td>
										 &yen;
									 </td>
									 <td>
										 &yen;
									 </td>
									 <td>
										 %
									 </td>
									 <td>
										 %
									 </td>

									 <td>
										 <input type="text" value="{{ $location_final_central[$k-1]->revenue }}" name="final_central_revenue_{{ $k }}" class="revenue-profit-input final revenue">
									 </td>
									 <td>
										 <input type="text" value="{{ $location_final_central[$k-1]->cost }}" name="final_central_cost_{{ $k }}" class="cost-profit-input final cost">
									 </td>
									 @if (empty($location_final_central[0]))
										 <td class="final-expense">
											 <span>&yen;</span>
											 <input type="hidden" value="" name="final_central_expense_{{ $k }}" class="expense-input final expense">
										 </td>
									 @else
										 <td class="final-expense">
											 <span>&yen;{{ $location_final_central[$k-1]->headoffice_expense }}</span>
											 <input type="hidden" value="{{ $location_final_central[$k-1]->headoffice_expense }}" name="final_central_expense_{{ $k }}" class="expense-input final expense">
										 </td>
									 @endif

									 <td class="final-profit">
										 <span>&yen;{{ $location_final_central[$k-1]->profit }}</span>
										 <input type="hidden" value="{{ $location_final_central[$k-1]->profit }}" class="final hidden-profit" name="final_central_profit_{{ $k }}">
									 </td>
									 <td class="final-profit-rate">
										 <span>%{{ $location_final_central[$k-1]->profit_rate }}</span>
										 <input type="hidden" value="{{ $location_final_central[$k-1]->profit_rate }}" class="final hidden-profit-rate" name="final_central_profitRate_{{ $k }}">
									 </td>
									 <td class="final-profit-gap">
										 <span>&yen;</span>
										 <input type="hidden" class="final hidden-profit-gap" name="final_central_profitGap_{{ $k }}">
									 </td>

								 </tr>
							 @endforeach
								 <tr class="subtotal">
									 <td>Subtotal</td>
									 <td>&yen;</td>
									 <td>&yen;</td>
									 <td>&yen;</td>
									 <td>%</td>
									 <td>%</td>

									 <td class="forecast-sub-sale">
										 <span>&yen;</span>
										 <input type="hidden" class="forecast sub-sale-hidden" name="forecast_central_sub_sale">
									 </td>
									 <td class="forecast-sub-cost">
										 <span>&yen;</span>
										 <input type="hidden" class="forecast sub-cost-hidden" name="forecast_central_sub_cost">
									 </td>
									 <td class="forecast-sub-expense">
										 <span>&yen;</span>
										 <input type="hidden" class="forecast sub-expense-hidden" name="forecast_central_sub_expense">
									 </td>
									 <td class="forecast-sub-profit">
										 <span>&yen;</span>
										 <input type="hidden" class="forecast sub-profit-hidden" name="forecast_central_sub_profit">
									 </td>
									 <td class="forecast-sub-profit-rate">
										 <span>%</span>
										 <input type="hidden" class="forecast sub-rate-hidden" name="forecast_central_sub_profit_rate">
									 </td>

									 <td>

									 </td>
									 <td>

									 </td>
									 <td>

									 </td>
									 <td>

									 </td>
									 <td>

									 </td>
									 <td>

									 </td>

									 <td class="final-sub-sale">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-sale-hidden" name="final_central_sub_sale">
									 </td>
									 <td class="final-sub-cost">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-cost-hidden" name="final_central_sub_cost">
									 </td>
									 <td class="final-sub-expense">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-expense-hidden" name="final_central_sub_expense">
									 </td>
									 <td class="final-sub-profit">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-profit-hidden" name="final_central_sub_profit">
									 </td>
									 <td class="final-sub-profit-rate">
										 <span>%</span>
										 <input type="hidden" value="" class="final sub-rate-hidden" name="final_central_sub_profit_rate">
									 </td>
									 <td class="final-sub-profit-gap">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-profitgap-hidden" name="final_central_sub_profitgap">
									 </td>
								 </tr>
							 </tbody>
						 </table>
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
									 <th style="background: #2ecc71; padding-left: 30px;" colspan="5">予測</th>
									 <th style="background: #3498db; padding-left: 30px;" colspan="6">進捗</th>
									 <th style="background: #f1c40f; padding-left: 30px;" colspan="6">確定数値</th>
								 </tr>
								 <tr>
									 <th>Location</th>
									 <th>Sales</th>
									 <th>Cost</th>
									 <th>Expense</th>
									 <th>Profit</th>
									 <th>Profit rate</th>

									 <th>Sales</th>
									 <th>Cost</th>
									 <th>Expense</th>
									 <th>Profit</th>
									 <th>Profit rate</th>

									 <th>Sales</th>
									 <th>Cost</th>
									 <th>Expense</th>
									 <th>Profit</th>
									 <th>Profit rate</th>
									 <th>Profit gap</th>

									 <th>Sales</th>
									 <th>Cost</th>
									 <th>Expense</th>
									 <th>Profit</th>
									 <th>Profit rate</th>
									 <th>Profit gap</th>

								 </tr>
							 </thead>
							 <tbody id="east">
							 @foreach ($location_forecast_east as $key)
								 {{ ++$j }}
								 <tr class="record">
									 <td>
										 {{ $key->location_name }}
										 <input type="hidden" name="location_east_{{ $j }}" value="{{ $key->location_name }}">
									 </td>
									 @if (empty($area_east_budget[0]))
										 <td>
											 &yen;
										 </td>
										 <td>
											 &yen;
										 </td>
										 <td>&yen;</td>
										 <td class="company-profit">
											 <span>&yen;</span>
											 <input type="hidden" class="hidden-profit" value="1600" name="budget_east_profit{{ $j }}">
										 </td>
										 <td>%</td>
									 	@else
											<td>
	 										 &yen;{{ $area_east_budget[$j-1]->revenue }}
	 									 </td>
	 									 <td>
	 										 &yen;{{ $area_east_budget[$j-1]->cost }}
	 									 </td>
	 									 <td>&yen;{{ $area_east_budget[$j-1]->headoffice_expense }}</td>
	 									 <td class="company-profit">
	 										 <span>&yen;{{ $area_east_budget[$j-1]->profit }}</span>
	 										 <input type="hidden" class="hidden-profit" value="1600" name="budget_east_profit{{ $j }}">
	 									 </td>
	 									 <td>{{ $area_east_budget[$j-1]->profit_rate }}%</td>
									 @endif


									 <td>
										 <input type="text" value="{{ $key->revenue }}" name="forecast_east_revenue_{{ $j }}" class="forecast revenue">
									 </td>
									 <td>
										 <input type="text" value="{{ $key->cost }}" name="forecast_east_cost_{{ $j }}" class="forecast cost">
									 </td>
									 @if (empty($area_east_budget[0]))
										 <td class="forecast-expense">
  										 <span>&yen;</span>
  										 <input type="hidden" value="" class="forecast expense" name="forecast_east_expense_{{ $j }}">
  									 </td>
									 @else
										 <td class="forecast-expense">
											 <span>&yen;{{ $area_east_budget[$j-1]->headoffice_expense }}</span>
											 <input type="hidden" value="{{ $area_east_budget[$j-1]->headoffice_expense }}" class="forecast expense" name="forecast_east_expense_{{ $j }}">
										 </td>
									 @endif

									 <td class="forecast-profit">
										 <span>&yen;{{ $key->profit }}</span>
										 <input type="hidden" value="{{ $key->profit }}" class="forecast hidden-profit" name="forecast_east_profit_{{ $j }}">
									 </td>
									 <td class="forecast-profit-rate">
										 <span>%{{ $key->profit_rate }}</span>
										 <input type="hidden" value="{{ $key->profit_rate }}" class="forecast hidden-profit-rate" name="forecast_east_profitRate_{{ $j }}">
									 </td>

									 <td>&yen;</td>
									 <td>
										 &yen;
									 </td>
									 <td>
										 &yen;
									 </td>
									 <td>
										 &yen;
									 </td>
									 <td>
										 %
									 </td>
									 <td>
										 %
									 </td>

									 <td>
										 <input type="text" value="{{ $location_final_east[$j-1]->revenue }}" name="final_east_revenue_{{ $j }}" class="revenue-profit-input final revenue">
									 </td>
									 <td>
										 <input type="text" value="{{ $location_final_east[$j-1]->cost }}" name="final_east_cost_{{ $j }}" class="cost-profit-input final cost">
									 </td>
									 @if (empty($location_final_east[0]))
										 <td class="final-expense">
											 <span>&yen;</span>
											 <input type="hidden" value="" name="final_east_expense_{{ $j }}" class="expense-input final expense">
										 </td>
									 @else
										 <td class="final-expense">
											 <span>&yen;{{ $location_final_east[$j-1]->headoffice_expense }}</span>
											 <input type="hidden" value="{{ $location_final_east[$j-1]->headoffice_expense }}" name="final_east_expense_{{ $j }}" class="expense-input final expense">
										 </td>
									 @endif

									 <td class="final-profit">
										 <span>&yen;{{ $location_final_east[$j-1]->profit }}</span>
										 <input type="hidden" value="{{ $location_final_east[$j-1]->profit }}" class="final hidden-profit" name="final_east_profit_{{ $j }}">
									 </td>
									 <td class="final-profit-rate">
										 <span>%{{ $location_final_east[$j-1]->profit_rate }}</span>
										 <input type="hidden" value="{{ $location_final_east[$j-1]->profit_rate }}" class="final hidden-profit-rate" name="final_east_profitRate_{{ $j }}">
									 </td>
									 <td class="final-profit-gap">
										 <span>&yen;</span>
										 <input type="hidden" class="final hidden-profit-gap" name="final_east_profitGap_{{ $j }}">
									 </td>

								 </tr>
							 @endforeach
								 <tr class="subtotal">
									 <td>Subtotal</td>
									 <td>&yen;</td>
									 <td>&yen;</td>
									 <td>&yen;</td>
									 <td>%</td>
									 <td>%</td>

									 <td class="forecast-sub-sale">
										 <span>&yen;</span>
										 <input type="hidden" class="forecast sub-sale-hidden" name="forecast_east_sub_sale">
									 </td>
									 <td class="forecast-sub-cost">
										 <span>&yen;</span>
										 <input type="hidden" class="forecast sub-cost-hidden" name="forecast_east_sub_cost">
									 </td>
									 <td class="forecast-sub-expense">
										 <span>&yen;</span>
										 <input type="hidden" class="forecast sub-expense-hidden" name="forecast_east_sub_expense">
									 </td>
									 <td class="forecast-sub-profit">
										 <span>&yen;</span>
										 <input type="hidden" class="forecast sub-profit-hidden" name="forecast_east_sub_profit">
									 </td>
									 <td class="forecast-sub-profit-rate">
										 <span>%</span>
										 <input type="hidden" class="forecast sub-rate-hidden" name="forecast_east_sub_profit_rate">
									 </td>

									 <td>

									 </td>
									 <td>

									 </td>
									 <td>

									 </td>
									 <td>

									 </td>
									 <td>

									 </td>
									 <td>

									 </td>

									 <td class="final-sub-sale">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-sale-hidden" name="final_east_sub_sale">
									 </td>
									 <td class="final-sub-cost">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-cost-hidden" name="final_east_sub_cost">
									 </td>
									 <td class="final-sub-expense">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-expense-hidden" name="final_east_sub_expense">
									 </td>
									 <td class="final-sub-profit">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-profit-hidden" name="final_east_sub_profit">
									 </td>
									 <td class="final-sub-profit-rate">
										 <span>%</span>
										 <input type="hidden" value="" class="final sub-rate-hidden" name="final_east_sub_profit_rate">
									 </td>
									 <td class="final-sub-profit-gap">
										 <span>&yen;</span>
										 <input type="hidden" value="" class="final sub-profitgap-hidden" name="final_east_sub_profitgap">
									 </td>
								 </tr>
							 </tbody>
						 </table>
					 </div>

					 <div class="gross_total">
						 <table>
							 <thead>
									 <tr>
										 <th></th>
										 <th>Sale</th>
										 <th>Cost</th>
										 <th>Expense</th>
										 <th>Profit</th>
										 <th>Profit Rate</th>

									 </tr>
								 </thead>
								 <tbody>
									 @if (empty($gross[0]))
										 <tr>
											 <td>Gross total</td>
											 <td>
												 <!-- Gross sale -->
											 </td>
											 <td>
												 <!-- Gross cost -->
											 </td>
											 <td>
												 <!-- Gross expense -->
											 </td>
											 <td>
												 <!-- Gross profit -->
											 </td>
											 <td>
												 <!-- Gross profit rate -->
											 </td>

										 </tr>
									 @else
										 <tr>
											 <td>Gross total</td>
											 <td>
												 &yen;{{ $gross[0]->revenue }}
												 <!-- Gross sale -->
											 </td>
											 <td>
												 &yen;{{ $gross[0]->cost }}
												 <!-- Gross cost -->
											 </td>
											 <td>
												 &yen;{{ $gross[0]->headoffice_expense }}
												 <!-- Gross expense -->
											 </td>
											 <td>
												 &yen;{{ $gross[0]->profit }}
												 <!-- Gross profit -->
											 </td>
											 <td>
												 {{ $gross[0]->profit }}%
												 <!-- Gross profit rate -->
											 </td>

										 </tr>
									 @endif
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
