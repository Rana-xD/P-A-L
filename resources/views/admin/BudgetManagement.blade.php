<!DOCTYPE html>
<html ng-app="app">
	<head>
		<title>Budget Management admin</title>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/css/styles.css">
		<link rel="stylesheet" type="text/css" href="/fonts/font-awesome.min.css">
		<script src="/js/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"><\/script>')</script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
		<script src="/js/validationcheck.js"></script>
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

			 	var month = @php
		 			echo $month;
		 		@endphp;
		 		var year = @php
		 			echo $year;
		 		@endphp;

			 	if(insert==1){
			 		swal("Done!", "Data have been inserted!", "success")
			 	}

				if(update==1){
			 		swal("Done!", "Data have been updated!", "success")
			 	}

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

		 		setTimeout(function(){
		 			$('#west .expense').each(function(){
			 			calcSubTotal($(this));
			 		});

			 		$('#central .expense').each(function(){
			 			calcSubTotal($(this));
			 		});

			 		$('#east .expense').each(function(){
			 			calcSubTotal($(this));
			 		});
		 		}, 300);

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
			.setting-rate-box,
			.sub-setting-rate-box {
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

			.warn {
        		border: 2px solid red !important;
      		}

	      	.custom-error {
	        	color: red;
	        	font-size: small;
	        	margin: 0;
	      	}
		</style>

	</head>
	<body ng-controller="MainCtrl">
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
											<li><a href="time_management">時間管理</a></li>
											<li><a href="budget">予算管理</a></li>
											{{-- <li><a href="kpi">L-KPI</a></li> --}}
											<li><a href="work">シフト表</a></li>
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
						<label for="month">月選択</label>
						<select id="month" name="month" style="margin-left: 5px; margin-right: 30px; width: 100px">
							<option value="" selected hidden></option>
							<option value="1">1月</option>
							<option value="2">2月</option>
							<option value="3">3月</option>
							<option value="4">4月</option>
							<option value="5">5月</option>
							<option value="6">6月</option>
							<option value="7">7月</option>
							<option value="8">8月</option>
							<option value="9">9月</option>
							<option value="10">10月</option>
							<option value="11">11月</option>
							<option value="12">12月</option>
						</select>

						<label for="year">年</label>
						<select id="year" name="year">
							<option value="" selected hidden></option>
							@php

								$curYear = Date("Y");
								for($i=2000; $i <= $curYear; $i++){
									echo "<option value='$i' id='$i'>$i</option>";
								}
							@endphp
						</select>
						<button type="submit" class="btn-sumit">確定</button>
					</div>
				</form>
				</br>
				<hr>
				<form action="budget-admin" name="budget_form" class="budget_form" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="month_a" id="month_a">
					<input type="hidden" name="year_a" id="year_a">
					<div class="tables-content">

						<div class="indi-area">
							<div class="area-heading">
								<h2>
									関東
								</h2>
							</div>
							<table class="scroll">
								<thead>
									<tr>
										<th style="background: transparent; padding-left: 30px;"></th>
										<th style="background: #e74c3c; padding-left: 30px;" colspan="6">予算</th>
										<th style="background: #2ecc71; padding-left: 30px;" colspan="5">予測</th>
										<th style="background: #3498db; padding-left: 30px;" colspan="6">進捗</th>
										<th style="background: #f1c40f; padding-left: 30px;" colspan="6">確定数値</th>
									</tr>
									<tr>
										<th>現場</th>
										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>目標引き上げ率</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>利益差</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>利益差</th>

									</tr>
								</thead>
								<tbody id="west">
									@foreach ($area_west as $key)
									<tr class="record">
										<td>{{ $key->location_name }}
											<input type="hidden" name="area_west_location_{{ ++$j }}" value="{{ $key->location_name }}">
										</td>

										<!-- Red header -->
										<td class="company-sale">
											<input type="text" value="0" name="area_west_revenue_{{ $j }}" ng-model="area_west_revenue_{{ $j }}" ng-init="area_west_revenue_{{ $j }}='0'" class="revenue-profit-input company revenue msg-id" numbers-only my-maxlength="9">
											<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
											<p class="custom-error err-req" style="display: none;">This field is required</p>
										</td>
										<td class="company-cost">
											<input type="text" value="0" name="area_west_cost_{{ $j }}" ng-model="area_west_cost_{{ $j }}" ng-init="area_west_cost_{{ $j }}='0'" class="cost-profit-input company cost msg-id" numbers-only my-maxlength="9">
											<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
											<p class="custom-error err-req" style="display: none;">This field is required</p>
										</td>
										<td class="company-expense">
											<input type="text" value="0" name="area_west_expense_{{ $j }}" ng-model="area_west_expense_{{ $j }}" ng-init="area_west_expense_{{ $j }}='0'" class="expense-input company expense msg-id" numbers-only my-maxlength="9">
											<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
											<p class="custom-error err-req" style="display: none;">This field is required</p>
										</td>
										<td class="company-profit">
											<span></span>
											<input type="hidden" class="company hidden-profit" name="area_west_profit_{{ $j }}">
										</td>
										<td class="company-profit-rate">
											<span></span>
											<input type="hidden" class="company hidden-profit-rate" name="area_west_profitRate_{{ $j }}">
										</td>
										<td class="company-setting-rate">
											<input type="text" value="0" name="area_west_settingRate_{{ $j }}" ng-model="area_west_settingRate_{{ $j }}" ng-init="area_west_settingRate_{{ $j }}='0'" class="setting-rate-box company msg-id" my-maxlength="10" valid-rate> %
											<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
											<p class="custom-error err-req" style="display: none;">This field is required</p>
										</td>

										<!--  -->
                    @if (empty($location_forecast_west[0]))
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
                        &yen;
                      </td>
                      <td>
                        %
                      </td>
                    @else
                      <td>
                        &yen;{{ $location_forecast_west[$j-1]->revenue }}
                      </td>
                      <td>
                        &yen;{{ $location_forecast_west[$j-1]->cost }}
                      </td>
                      <td>
                        &yen;
                      </td>
                      <td>
                        &yen;{{ $location_forecast_west[$j-1]->profit }}
                      </td>
                      <td>
                        {{ $location_forecast_west[$j-1]->profit_rate }}%
                      </td>
                    @endif

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
											&yen;
										</td>
										<td>
											%
										</td>
										<td>
											&yen;
										</td>

                    @if (empty($location_final_west[0]))
                      <td class="final-sale">
  										<span>&yen;</span>
  										<input type="hidden" value="" name="final_west_revenue_{{ $j }}" class="revenue-profit-input final revenue">
  									</td>
  									<td class="final-cost">
  										<span>&yen;</span>
  										<input type="hidden" value="" name="final_west_cost_{{ $j }}" class="cost-profit-input final cost">
  									</td>
										<td class="final-expense">
											<span>&yen;</span>
											<input type="hidden" value="" name="final_west_expense_{{ $j }}" class="expense-input final expense">
										</td>
  									<td class="final-profit">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit" name="final_west_profit_{{ $j }}">
  									</td>
  									<td class="final-profit-rate">
  										<span>%</span>
  										<input type="hidden" class="final hidden-profit-rate" name="final_west_profitRate_{{ $j }}">
  									</td>
  									<td class="final-profit-gap">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit-gap" name="final_west_profitGap_{{ $j }}">
  									</td>
                      @else
                        <td class="final-sale">
    										<span>&yen;{{ $location_final_west[$j-1]->revenue}}</span>
    										<input type="hidden" value="{{ $location_final_west[$j-1]->revenue}}" name="final_west_revenue_{{ $j }}" class="revenue-profit-input final revenue">
    									</td>
    									<td class="final-cost">
    										<span>&yen;{{ $location_final_west[$j-1]->cost}}</span>
    										<input type="hidden" value="{{ $location_final_west[$j-1]->cost}}" name="final_west_cost_{{ $j }}" class="cost-profit-input final cost">
    									</td>
                      <td class="final-expense">
                        <span>&yen;</span>
                        <input type="hidden" value="" name="final_west_expense_{{ $j }}" class="expense-input final expense">
                      </td>
    									<td class="final-profit">
    										<span>&yen;{{ $location_final_west[$j-1]->profit}}</span>
    										<input type="hidden" value="{{ $location_final_west[$j-1]->profit}}" class="final hidden-profit" name="final_west_profit_{{ $j }}">
    									</td>
    									<td class="final-profit-rate">
    										<span>%{{ $location_final_west[$j-1]->profit_rate}}</span>
    										<input type="hidden" value="{{ $location_final_west[$j-1]->profit_rate}}" class="final hidden-profit-rate" name="final_west_profitRate_{{ $j }}">
    									</td>
    									<td class="final-profit-gap">
    										<span>&yen;</span>
    										<input type="hidden" class="final hidden-profit-gap" name="final_west_profitGap_{{ $j }}">
    									</td>
                    @endif

									</tr>
									@endforeach
									<tr class="subtotal">
										<td>地区合計</td>
										<td class="sub-sale">
											<span></span>
											<input type="hidden" class="company sub-sale-hidden" name="company_west_sub_sale">
										</td>
										<td class="sub-cost">
											<span></span>
											<input type="hidden" class="company sub-cost-hidden" name="company_west_sub_cost">
										</td>
										<td class="sub-expense">
											<span>&yen;</span>
											<input type="hidden" class="company sub-expense-hidden" name="comapny_west_sub_expense">
										</td>
										<td class="sub-profit">
											<span></span>
											<input type="hidden" class="company sub-profit-hidden" name="company_west_sub_profit">
										</td>
										<td class="sub-profit-rate">
											<span></span>
											<input type="hidden" class="company sub-rate-hidden" name="comapny_west_sub_profit_rate">
										</td>
										<td class="sub-setting-rate">
											<span>%</span>
											<input type="hidden" name="company_west_sub_setting_rate" class="company sub-setting-rate-hidden">
										</td>
										@if (empty($sub_forecast_west[0]))
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
												&yen;
											</td>
											<td>
												%
											</td>
											@else
												<td>
													&yen;{{ $sub_forecast_west[0]->revenue }}
												</td>
												<td>
													&yen;{{ $sub_forecast_west[0]->cost }}
												</td>
												<td>
													&yen;{{ $sub_forecast_west[0]->headoffice_expense }}
												</td>
												<td>
													&yen;{{ $sub_forecast_west[0]->profit }}
												</td>
												<td>
													{{ $sub_forecast_west[0]->profit_rate }}%
												</td>
										@endif


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
											&yen;
										</td>
										<td>
											&yen;
										</td>
										<td>
											&yen;
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
							<hr>
						</div>

						<div class="indi-area">
							<div class="area-heading">
								<h2>
									中部
								</h2>
							</div>
							<table class="scroll">
								<thead>
									<tr>
										<th style="background: transparent; padding-left: 30px;"></th>
										<th style="background: #e74c3c; padding-left: 30px;" colspan="6">予算</th>
										<th style="background: #2ecc71; padding-left: 30px;" colspan="5">予測</th>
										<th style="background: #3498db; padding-left: 30px;" colspan="6">進捗</th>
										<th style="background: #f1c40f; padding-left: 30px;" colspan="6">確定数値</th>
									</tr>
									<tr>
										<th>現場</th>
										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>目標引き上げ率</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>利益差</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>利益差</th>

									</tr>
								</thead>
								<tbody id="central">
									@foreach ($area_central as $key)
									<tr class="record">
										<td>
											{{ $key->location_name }}
											<input type="hidden" name="area_central_location_{{ ++$l }}" value="{{ $key->location_name }}">
										</td>
										<td class="company-sale">
											<input type="text" value="0" name="area_central_revenue_{{ $l }}" ng-model="area_central_revenue_{{ $l }}" ng-init="area_central_revenue_{{ $l }}='0'" class="revenue-profit-input company revenue msg-id" numbers-only my-maxlength="9">
											<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
											<p class="custom-error err-req" style="display: none;">This field is required</p>
										</td>
										<td class="company-cost">
											<input type="text" value="0" name="area_central_cost_{{ $l }}" ng-model="area_central_cost_{{ $l }}" ng-init="area_central_cost_{{ $l }}='0'" class="cost-profit-input company cost msg-id" numbers-only my-maxlength="9">
											<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
											<p class="custom-error err-req" style="display: none;">This field is required</p>
										</td>
										<td class="company-expense">
											<input type="text" value="0" name="area_central_expense_{{ $l }}" ng-model="area_central_expense_{{ $l }}" ng-init="area_central_expense_{{ $l }}='0'" class="expense-input company expense msg-id" numbers-only my-maxlength="9">
											<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
											<p class="custom-error err-req" style="display: none;">This field is required</p>
										</td>
										<td class="company-profit">
											<span>&yen;</span>
											<input type="hidden" class="company hidden-profit" name="area_central_profit_{{ $l }}">
										</td>
										<td class="company-profit-rate">
											<span>%</span>
											<input type="hidden" class="company hidden-profit-rate" name="area_central_profitRate_{{ $l }}">
										</td>
										<td>
											<input type="text" value="0" name="area_central_settingRate_{{ $l }}" ng-model="area_central_settingRate_{{ $l }}" ng-init="area_central_settingRate_{{ $l }}='0'" class="setting-rate-box company msg-id" numbers-only my-maxlength="9" valid-rate> %
											<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
											<p class="custom-error err-req" style="display: none;">This field is required</p>
										</td>

                    @if (empty($location_forecast_central[0]))
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
    										&yen;
    									</td>
    									<td>
    										%
    									</td>
                    @else
                      <td>
    										&yen;{{ $location_forecast_central[$l-1]->revenue }}
    									</td>
    									<td>
    										&yen;{{ $location_forecast_central[$l-1]->cost }}
    									</td>
    									<td>
    										&yen;
    									</td>
    									<td>
    										&yen;{{ $location_forecast_central[$l-1]->profit }}
    									</td>
    									<td>
    										{{ $location_forecast_central[$l-1]->profit_rate }}%
    									</td>
                    @endif

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
											&yen;
										</td>
										<td>
											%
										</td>
										<td>
											&yen;
										</td>

                    @if (empty($location_final_central[0]))
                      <td class="final-sale">
  										<span>&yen;</span>
  										<input type="hidden" value="3000" name="final_central_revenue_{{ $l }}" class="revenue-profit-input final revenue">
  									</td>
  									<td class="final-cost">
  										<span>&yen;</span>
  										<input type="hidden" value="200" name="final_central_cost_{{ $l }}" class="cost-profit-input final cost">
  									</td>
                    <td class="final-expense">
                      <span>&yen;</span>
                      <input type="hidden" value="" name="final_central_expense_{{ $l }}" class="expense-input final expense">
                    </td>
  									<td class="final-profit">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit" name="final_central_profit_{{ $l }}">
  									</td>
  									<td class="final-profit-rate">
  										<span>%</span>
  										<input type="hidden" class="final hidden-profit-rate" name="final_central_profitRate_{{ $l }}">
  									</td>
  									<td class="final-profit-gap">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit-gap" name="final_central_profitGap_{{ $l }}">
  									</td>
                    @else
                      <td class="final-sale">
  										<span>&yen;{{ $location_final_central[$l-1]->revenue }}</span>
  										<input type="hidden" value="{{ $location_final_central[$l-1]->revenue }}" name="final_central_revenue_{{ $l }}" class="revenue-profit-input final revenue">
  									</td>
  									<td class="final-cost">
  										<span>&yen;{{ $location_final_central[$l-1]->cost }}</span>
  										<input type="hidden" value="{{ $location_final_central[$l-1]->cost }}" name="final_central_cost_{{ $l }}" class="cost-profit-input final cost">
  									</td>
                    <td class="final-expense">
                      <span>&yen;</span>
                      <input type="hidden" value="" name="final_central_expense_{{ $l }}" class="expense-input final expense">
                    </td>
  									<td class="final-profit">
  										<span>&yen;{{ $location_final_central[$l-1]->profit }}</span>
  										<input type="hidden" value="{{ $location_final_central[$l-1]->profit }}" class="final hidden-profit" name="final_central_profit_{{ $l }}">
  									</td>
  									<td class="final-profit-rate">
  										<span>{{ $location_final_central[$l-1]->profit_rate }}%</span>
  										<input type="hidden" value="{{ $location_final_central[$l-1]->profit_rate }}" class="final hidden-profit-rate" name="final_central_profitRate_{{ $l }}">
  									</td>
  									<td class="final-profit-gap">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit-gap" name="final_central_profitGap_{{ $l }}">
  									</td>
                    @endif

									</tr>
									@endforeach
									<tr class="subtotal">
										<td>地区合計</td>
										<td class="sub-sale">
											<span></span>
											<input type="hidden" class="company sub-sale-hidden" name="company_central_sub_sale">
										</td>
										<td class="sub-cost">
											<span></span>
											<input type="hidden" class="company sub-cost-hidden" name="company_central_sub_cost">
										</td>
										<td class="sub-expense">
											<span>&yen;</span>
											<input type="hidden" class="company sub-expense-hidden" name="company_central_sub_expense">
										</td>
										<td class="sub-profit">
											<span></span>
											<input type="hidden" class="company sub-profit-hidden" name="company_central_sub_profit">
										</td>
										<td class="sub-profit-rate">
											<span></span>
											<input type="hidden" class="company sub-rate-hidden" name="company_central_sub_profit_rate">
										</td>
										<td class="sub-setting-rate">
											<span>%</span>
											<input type="hidden" name="company_central_sub_setting_rate" class="company sub-setting-rate-hidden">
										</td>

										@if (empty($sub_forecast_central[0]))
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
												&yen;
											</td>
											<td>
												%
											</td>
											@else
												<td>
													&yen;{{ $sub_forecast_central[0]->revenue }}
												</td>
												<td>
													&yen;{{ $sub_forecast_central[0]->cost }}
												</td>
												<td>
													&yen;{{ $sub_forecast_central[0]->headoffice_expense }}
												</td>
												<td>
													&yen;{{ $sub_forecast_central[0]->profit }}
												</td>
												<td>
													{{ $sub_forecast_central[0]->profit_rate }}%
												</td>
										@endif

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
											&yen;
										</td>
										<td>
											&yen;
										</td>
										<td>
											&yen;
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
							<hr>
						</div>

						<div class="indi-area">
							<div class="area-heading">
								<h2>
									関西
								</h2>
							</div>
							<table class="scroll">
								<thead>
									<tr>
										<th style="background: transparent; padding-left: 30px;"></th>
										<th style="background: #e74c3c; padding-left: 30px;" colspan="6">予算</th>
										<th style="background: #2ecc71; padding-left: 30px;" colspan="5">予測</th>
										<th style="background: #3498db; padding-left: 30px;" colspan="6">進捗</th>
										<th style="background: #f1c40f; padding-left: 30px;" colspan="6">確定数値</th>
									</tr>
									<tr>
										<th>現場</th>
										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>目標引き上げ率</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>利益差</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>利益差</th>

									</tr>
								</thead>
								<tbody id="east">
									@foreach ($area_east as $key)
									<tr class="record">
										<td>
											{{ $key->location_name }}
											<input type="hidden" name="area_east_location_{{ ++$k }}" value="{{ $key->location_name }}">
										</td>
										<td class="company-sale">
											<input type="text" value="0" name="area_east_revenue_{{ $k }}" ng-model="area_east_revenue_{{ $k }}" ng-init="area_east_revenue_{{ $k }}='0'" class="revenue-profit-input company revenue msg-id" numbers-only my-maxlength="9">
											<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
											<p class="custom-error err-req" style="display: none;">This field is required</p>
										</td>
										<td class="company-cost">
											<input type="text" value="0" name="area_east_cost_{{ $k }}" ng-model="area_east_cost_{{ $k }}" ng-init="area_east_cost_{{ $k }}='0'" class="cost-profit-input company cost msg-id" numbers-only my-maxlength="9">
											<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
											<p class="custom-error err-req" style="display: none;">This field is required</p>
										</td>
										<td class="company-expense">
											<input type="text" value="0" name="area_east_expense_{{ $k }}" ng-model="area_east_expense_{{ $k }}" ng-init="area_east_expense_{{ $k }}='0'" class="expense-input company expense msg-id" numbers-only my-maxlength="9">
											<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
											<p class="custom-error err-req" style="display: none;">This field is required</p>
										</td>
										<td class="company-profit">
											<span>&yen;</span>
											<input type="hidden"  class="company hidden-profit" name="area_east_profit_{{ $k }}">
										</td>
										<td class="company-profit-rate">
											<span>&yen;</span>
											<input type="hidden"  class="company hidden-profit-rate" name="area_east_profitRate_{{ $k }}">
										</td>
										<td class="company-setting-rate">
											<input type="text" value="0" name="area_east_settingRate_{{ $k }}" ng-model="area_east_settingRate_{{ $k }}" ng-init="area_east_settingRate_{{ $k }}='0'" value="" class="setting-rate-box company msg-id"  numbers-only my-maxlength="9" valid-rate> %
											<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
											<p class="custom-error err-req" style="display: none;">This field is required</p>
										</td>

                    @if (empty($location_forecast_east[0]))
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
  										&yen;
  									</td>
  									<td>
  										%
  									</td>
                    @else
                      <td>
  										&yen;{{ $location_forecast_east[$k-1]->revenue }}
  									</td>
  									<td>
  										&yen;{{ $location_forecast_east[$k-1]->cost }}
  									</td>
  									<td>
  										&yen;
  									</td>
  									<td>
  										&yen;{{ $location_forecast_east[$k-1]->profit }}
  									</td>
  									<td>
  										{{ $location_forecast_east[$k-1]->profit_rate }}%
  									</td>
                    @endif

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
											&yen;
										</td>
										<td>
											%
										</td>
										<td>
											&yen;
										</td>

                    @if (empty($location_final_east[0]))
                      <td class="final-sale">
  										<span>&yen;</span>
  										<input type="hidden" value="" name="final_east_revenue_{{ $k }}" class="revenue-profit-input final revenue">
  									</td>
  									<td class="final-cost">
  										<span>&yen;</span>
  										<input type="hidden" value="" name="final_east_cost_{{ $k }}" class="cost-profit-input final cost">
  									</td>
                    <td class="final-expense">
                      <span>&yen;</span>
                      <input type="hidden" value="" name="final_east_expense_{{ $k }}" class="expense-input final expense">
                    </td>
  									<td class="final-profit">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit" name="final_east_profit_{{ $k }}">
  									</td>
  									<td class="final-profit-rate">
  										<span>%</span>
  										<input type="hidden" class="final hidden-profit-rate" name="final_east_profitRate_{{ $k }}">
  									</td>
  									<td class="final-profit-gap">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit-gap" name="final_west_profitGap_{{ $k }}">
  									</td>
                    @else
                      <td class="final-sale">
  										<span>&yen;{{ $location_final_east[$k-1]->revenue }}</span>
  										<input type="hidden" value="{{ $location_final_east[$k-1]->revenue }}" name="final_east_revenue_{{ $k }}" class="revenue-profit-input final revenue">
  									</td>
  									<td class="final-cost">
  										<span>&yen;{{ $location_final_east[$k-1]->cost }}</span>
  										<input type="hidden" value="{{ $location_final_east[$k-1]->cost }}" name="final_east_cost_{{ $k }}" class="cost-profit-input final cost">
  									</td>
                    <td class="final-expense">
                      <span>&yen;</span>
                      <input type="hidden" value="" name="final_east_expense_{{ $k }}" class="expense-input final expense">
                    </td>
  									<td class="final-profit">
  										<span>&yen;{{ $location_final_east[$k-1]->profit }}</span>
  										<input type="hidden" value="{{ $location_final_east[$k-1]->profit }}" class="final hidden-profit" name="final_east_profit_{{ $k }}">
  									</td>
  									<td class="final-profit-rate">
  										<span>{{ $location_final_east[$k-1]->profit_rate }}%</span>
  										<input type="hidden" value="{ $location_final_east[$k-1]->profit_rate }}" class="final hidden-profit-rate" name="final_east_profitRate_{{ $k }}">
  									</td>
  									<td class="final-profit-gap">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit-gap" name="final_west_profitGap_{{ $k }}">
  									</td>
                    @endif

									</tr>
									@endforeach
									<tr class="subtotal">
										<td>地区合計</td>
										<td class="sub-sale">
											<span>&yen;</span>
											<input type="hidden" class="company sub-sale-hidden" name="company_east_sub_sale">
										</td>
										<td class="sub-cost">
											<span></span>
											<input type="hidden" class="company sub-cost-hidden" name="company_east_sub_cost">
										</td>
										<td class="sub-expense">
											<span>&yen;</span>
											<input type="hidden" class="company sub-expense-hidden" name="company_east_sub_expense">
										</td>
										<td class="sub-profit">
											<span></span>
											<input type="hidden" class="company sub-profit-hidden" name="company_east_sub_profit">
										</td>
										<td class="sub-profit-rate">
											<span></span>
											<input type="hidden" class="company sub-rate-hidden" name="company_east_sub_profit_rate">
										</td>
										<td class="sub-setting-rate">
											<span>%</span>
											<input type="hidden" name="company_east_sub_setting_rate" class="company sub-setting-rate-hidden">
										</td>

										@if (empty($sub_forecast_east[0]))
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
												&yen;
											</td>
											<td>
												%
											</td>
											@else
												<td>
													&yen;{{ $sub_forecast_east[0]->revenue }}
												</td>
												<td>
													&yen;{{ $sub_forecast_east[0]->cost }}
												</td>
												<td>
													&yen;{{ $sub_forecast_east[0]->headoffice_expense }}
												</td>
												<td>
													&yen;{{ $sub_forecast_east[0]->profit }}
												</td>
												<td>
													{{ $sub_forecast_east[0]->profit_rate }}%
												</td>
										@endif

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
											&yen;
										</td>
										<td>
											&yen;
										</td>
										<td>
											&yen;
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
							<hr>
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
										<th>Setting Rate</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>全国合計</td>
										<td class="gross-sale">
											<span>&yen;</span>
											<input type="hidden" value="" name="gross_sale" class="gross-sale-hidden">
										</td>
										<td class="gross-cost">
											<span>&yen;</span>
											<input type="hidden" value="" name="gross_cost" class="gross-cost-hidden">
										</td>
										<td class="gross-expense">
											<span>&yen;</span>
											<input type="hidden" value="" name="gross_expense" class="gross-expense-hidden">
										</td>
										<td class="gross-profit">
											<span>&yen;</span>
											<input type="hidden" value="" name="gross_profit" class="gross-profit-hidden">
										</td>
										<td class="gross-profit-rate">
											<span>&yen;</span>
											<input type="hidden" value="" name="gross_profit_rate" class="gross-profit-rate-hidden">
										</td>
										{{-- <td class="gross-setting-rate">
											<span>&yen;</span>
											<input type="hidden" value="" name="gross-setting-rate" class="gross-setting-rate-hidden">
										</td>	 --}}

									</tr>
								</tbody>
							</table>
						</div>

						<div class="submit-row">
	            	<button type="submit" class="btn-sumit">確定</button>
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
					<label for="month">月選択</label>
					<select id="month" name="month" style="margin-left: 5px; margin-right: 30px; width: 100px">
						<option value="" selected hidden></option>
						<option value="1">1月</option>
						<option value="2">2月</option>
						<option value="3">3月</option>
						<option value="4">4月</option>
						<option value="5">5月</option>
						<option value="6">6月</option>
						<option value="7">7月</option>
						<option value="8">8月</option>
						<option value="9">9月</option>
						<option value="10">10月</option>
						<option value="11">11月</option>
						<option value="12">12月</option>
					</select>

					<label for="year">年</label>
					<select id="year" name="year">
						<option value="" selected hidden></option>
						@php

							$curYear = Date("Y");
							for($i=2000; $i <= $curYear; $i++){
								echo "<option value='$i' id='$i'>$i</option>";
							}
						@endphp
					</select>
					<button type="submit" class="btn-sumit">確定</button>
				</div>
				</form>
				</br>
				<hr>
				<form action="budget-admin" name="budget_form" class="budget_form" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="month_a" id="month_a">
					<input type="hidden" name="year_a" id="year_a">
				  <div class="tables-content">

  					<div class="indi-area">
  						<div class="area-heading">
  							<h2>
  								関東
  							</h2>
  						</div>
  						<table class="scroll">
  							<thead>
  								<tr>
  									<th style="background: transparent; padding-left: 30px;"></th>
  									<th style="background: #e74c3c; padding-left: 30px;" colspan="6">予算</th>
  									<th style="background: #2ecc71; padding-left: 30px;" colspan="5">予測</th>
  									<th style="background: #3498db; padding-left: 30px;" colspan="6">進捗</th>
  									<th style="background: #f1c40f; padding-left: 30px;" colspan="6">確定数値</th>
  								</tr>
  								<tr>
										<th>現場</th>
										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>目標引き上げ率</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>利益差</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>利益差</th>

  								</tr>
  							</thead>
  							<tbody id="west">
  								@foreach ($area_west_budget as $key)
  								<tr class="record">
  									<td>{{ $key->location_name }}
  										<input type="hidden" name="area_west_location_{{ ++$j }}" value="{{ $key->location_name }}">
  									</td>

  									<td class="company-sale">
  										<input type="text" value="{{ $key->revenue }}" name="area_west_revenue_{{ $j }}" ng-model="area_west_revenue_{{ $j }}" ng-init="area_west_revenue_{{ $j }}='{{ $key->revenue }}'" class="revenue-profit-input company revenue msg-id" numbers-only my-maxlength="9">
  										<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
										<p class="custom-error err-req" style="display: none;">This field is required</p>
  									</td>
  									<td class="company-cost">
  										<input type="text" value="{{ $key->cost }}" name="area_west_cost_{{ $j }}" ng-model="area_west_cost_{{ $j }}" ng-init="area_west_cost_{{ $j }}='{{ $key->cost }}'" class="cost-profit-input company cost msg-id" numbers-only my-maxlength="9">
  										<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
										<p class="custom-error err-req" style="display: none;">This field is required</p>
  									</td>
  									<td class="company-expense">
  										<input type="text" value="{{ $key->headoffice_expense }}" name="area_west_expense_{{ $j }}" ng-model="area_west_expense_{{ $j }}" ng-init="area_west_expense_{{ $j }}='{{ $key->headoffice_expense }}'" class="expense-input company expense msg-id" numbers-only my-maxlength="9">
  										<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
										<p class="custom-error err-req" style="display: none;">This field is required</p>
  									</td>
  									<td class="company-profit">
  										<span>&yen;{{ $key->profit }}</span>
  										<input type="hidden" value="{{ $key->profit }}" class="company hidden-profit" name="area_west_profit_{{ $j }}">
  									</td>
  									<td class="company-profit-rate">
  										<span>{{ $key->profit_rate }}%</span>
  										<input type="hidden" value="{{ $key->profit_rate }}" class="company hidden-profit-rate" name="area_west_profitRate_{{ $j }}">
  									</td>
  									<td class="company-setting-rate">
  										<input type="text" value="{{ $key->setting_rate }}" name="area_west_settingRate_{{ $j }}" ng-model="area_west_settingRate_{{ $j }}" ng-init="area_west_settingRate_{{ $j }}='{{ $key->setting_rate }}'" class="setting-rate-box company msg-id"  numbers-only my-maxlength="9"> %
  										<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
										<p class="custom-error err-req" style="display: none;">This field is required</p>
  									</td>
                    @if (empty($location_forecast_west[0]))
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
    										&yen;
    									</td>
    									<td>
    										%
    									</td>
                    @else
                      <td>
    										&yen;{{ $location_forecast_west[$j-1]->revenue }}
    									</td>
                      <td>
    										&yen;{{ $location_forecast_west[$j-1]->cost }}
    									</td>
    									<td>
    										&yen;{{ $area_west_budget[$j-1]->headoffice_expense }}
    									</td>
    									<td>
    										&yen;{{ $location_forecast_west[$j-1]->profit }}
    									</td>
    									<td>
    										{{ $location_forecast_west[$j-1]->profit_rate }}%
    									</td>
                    @endif



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
  										&yen;
  									</td>
  									<td>
  										%
  									</td>
  									<td>
  										&yen;
  									</td>

                    @if (empty($location_final_west[0]))
                      <td class="final-sale">
  										<span>&yen;</span>
  										<input type="hidden" value="" name="final_west_revenue_{{ $j }}" class="revenue-profit-input final revenue">
  									</td>
  									<td class="final-cost">
  										<span>&yen;</span>
  										<input type="hidden" value="" name="final_west_cost_{{ $j }}" class="cost-profit-input final cost">
  									</td>
                    <td class="final-expense">
                      <span>&yen;{{ $key->headoffice_expense }}</span>
                      <input type="hidden" value="{{ $key->headoffice_expense }}" name="final_west_expense_{{ $j }}" class="expense-input final expense">
                    </td>
  									<td class="final-profit">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit" name="final_west_profit_{{ $j }}">
  									</td>
  									<td class="final-profit-rate">
  										<span>%</span>
  										<input type="hidden" class="final hidden-profit-rate" name="final_west_profitRate_{{ $j }}">
  									</td>
  									<td class="final-profit-gap">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit-gap" name="final_west_profitGap_{{ $j }}">
  									</td>
                      @else
                        <td class="final-sale">
    										<span>&yen;{{ $location_final_west[$j-1]->revenue}}</span>
    										<input type="hidden" value="{{ $location_final_west[$j-1]->revenue}}" name="final_west_revenue_{{ $j }}" class="revenue-profit-input final revenue">
    									</td>
    									<td class="final-cost">
    										<span>&yen;{{ $location_final_west[$j-1]->cost}}</span>
    										<input type="hidden" value="{{ $location_final_west[$j-1]->cost}}" name="final_west_cost_{{ $j }}" class="cost-profit-input final cost">
    									</td>
                      <td class="final-expense">
                        <span>&yen;{{ $key->headoffice_expense }}</span>
                        <input type="hidden" value="{{ $key->headoffice_expense }}" name="final_west_expense_{{ $j }}" class="expense-input final expense">
                      </td>
    									<td class="final-profit">
    										<span>&yen;{{ $location_final_west[$j-1]->profit}}</span>
    										<input type="hidden" value="{{ $location_final_west[$j-1]->profit}}" class="final hidden-profit" name="final_west_profit_{{ $j }}">
    									</td>
    									<td class="final-profit-rate">
    										<span>%{{ $location_final_west[$j-1]->profit_rate}}</span>
    										<input type="hidden" value="{{ $location_final_west[$j-1]->profit_rate}}" class="final hidden-profit-rate" name="final_west_profitRate_{{ $j }}">
    									</td>
    									<td class="final-profit-gap">
    										<span>&yen;</span>
    										<input type="hidden" class="final hidden-profit-gap" name="final_west_profitGap_{{ $j }}">
    									</td>
                    @endif


  								</tr>
  								@endforeach
  								<tr class="subtotal">
  									<td>地区合計</td>
  									<td class="sub-sale">
  										<span></span>
  										<input type="hidden" class="company sub-sale-hidden" name="company_west_sub_sale">
  									</td>
  									<td class="sub-cost">
  										<span></span>
  										<input type="hidden" class="company sub-cost-hidden" name="company_west_sub_cost">
  									</td>
  									<td class="sub-expense">
  										<span>&yen;</span>
  										<input type="hidden" class="company sub-expense-hidden" name="company_west_sub_expense">
  									</td>
  									<td class="sub-profit">
  										<span></span>
  										<input type="hidden" class="company sub-profit-hidden" name="company_west_sub_profit">
  									</td>
  									<td class="sub-profit-rate">
  										<span></span>
  										<input type="hidden" class="company sub-rate-hidden" name="company_west_sub_profit_rate">
  									</td>
  									<td class="sub-setting-rate">
  										<span>%</span>
  										<input type="hidden" name="company_west_sub_setting_rate" class="company sub-setting-rate-hidden">
  									</td>

										@if (empty($sub_forecast_west[0]))
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
												&yen;
											</td>
											<td>
												%
											</td>
											@else
												<td>
													&yen;{{ $sub_forecast_west[0]->revenue }}
												</td>
												<td>
													&yen;{{ $sub_forecast_west[0]->cost }}
												</td>
												<td>
													&yen;{{ $sub_forecast_west[0]->headoffice_expense }}
												</td>
												<td>
													&yen;{{ $sub_forecast_west[0]->profit }}
												</td>
												<td>
													{{ $sub_forecast_west[0]->profit_rate }}%
												</td>
										@endif

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
  										&yen;
  									</td>
  									<td>
  										&yen;
  									</td>
  									<td>
  										&yen;
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
  						<hr>

  						<form action="budget-admin" class="budget_form" name="budget-admin" method="POST" novalidate="novalidate">

  					</div>

  					<div class="indi-area">
  						<div class="area-heading">
  							<h2>
  								中部
  							</h2>
  						</div>
  						<table class="scroll">
  							<thead>
  								<tr>
  									<th style="background: transparent; padding-left: 30px;"></th>
  									<th style="background: #e74c3c; padding-left: 30px;" colspan="6">予算</th>
  									<th style="background: #2ecc71; padding-left: 30px;" colspan="5">予測</th>
  									<th style="background: #3498db; padding-left: 30px;" colspan="6">進捗</th>
  									<th style="background: #f1c40f; padding-left: 30px;" colspan="6">確定数値</th>
  								</tr>
  								<tr>
										<th>現場</th>
										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>目標引き上げ率</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>利益差</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>利益差</th>

  								</tr>
  							</thead>
  							<tbody id="central">
  								@foreach ($area_central_budget as $key)
  								<tr class="record">
  									<td>{{ $key->location_name }}
  									<input type="hidden" name="area_central_location_{{ ++$l }}" value="{{ $key->location_name }}"></td>
  									<td class="company-sale">
  										<input type="text" value="{{ $key->revenue }}" name="area_central_revenue_{{ $l }}" ng-model="area_central_revenue_{{ $l }}" ng-init="area_central_revenue_{{ $l }}='{{ $key->revenue }}'" class="revenue-profit-input company revenue msg-id"  numbers-only my-maxlength="9">
  										<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
										<p class="custom-error err-req" style="display: none;">This field is required</p>
  									</td>
  									<td class="company-cost">
  										<input type="text" value="{{ $key->cost }}" name="area_central_cost_{{ $l }}" ng-model="area_central_cost_{{ $l }}" ng-init="area_central_cost_{{ $l }}='{{ $key->cost }}'" class="cost-profit-input company cost msg-id"  numbers-only my-maxlength="9">
  										<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
										<p class="custom-error err-req" style="display: none;">This field is required</p>
  									</td>
  									<td class="company-expense">
  										<input type="text" value="{{ $key->headoffice_expense }}" name="area_central_expense_{{ $l }}" ng-model="area_central_expense_{{ $l }}" ng-init="area_central_expense_{{ $l }}='{{ $key->headoffice_expense }}'" class="expense-input company expense msg-id"  numbers-only my-maxlength="9">
  										<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
										<p class="custom-error err-req" style="display: none;">This field is required</p>
  									</td>
  									<td class="company-profit">
  										<span>&yen;{{ $key->profit }}</span>
  										<input type="hidden" value="{{ $key->profit }}" class="company hidden-profit" name="area_central_profit_{{ $l }}">
  									</td>
  									<td class="company-profit-rate">
  										<span>{{ $key->profit_rate }}%</span>
  										<input type="hidden" value="{{ $key->profit_rate }}" class="company hidden-profit-rate" name="area_central_profitRate_{{ $l }}">
  									</td>
  									<td class="company-setting-rate">
  										<input type="text" value="{{ $key->setting_rate }}" name="area_central_settingRate_{{ $l }}" ng-model="area_central_settingRate_{{ $l }}" ng-init="area_central_settingRate_{{ $l }}='{{ $key->setting_rate }}'" class="setting-rate-box company msg-id" numbers-only my-maxlength="9" valid-rate> %
  										<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
										<p class="custom-error err-req" style="display: none;">This field is required</p>
  									</td>

                    @if (empty($location_forecast_central[0]))
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
    										&yen;
    									</td>
    									<td>
    										%
    									</td>
                    @else
                      <td>
    										&yen;{{ $location_forecast_central[$l-1]->revenue }}
    									</td>
    									<td>
    										&yen;{{ $location_forecast_central[$l-1]->cost }}
    									</td>
    									<td>
    										&yen;{{ $area_central_budget[$l-1]->headoffice_expense }}
    									</td>
    									<td>
    										&yen;{{ $location_forecast_central[$l-1]->profit }}
    									</td>
    									<td>
    										{{ $location_forecast_central[$l-1]->profit_rate }}%
    									</td>
                    @endif

                    {{-- daily progress --}}
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
  										&yen;
  									</td>
  									<td>
  										%
  									</td>
  									<td>
  										&yen;
  									</td>
                    @if (empty($location_final_central[0]))
                      <td class="final-sale">
  										<span>&yen;</span>
  										<input type="hidden" value="3000" name="final_central_revenue_{{ $l }}" class="revenue-profit-input final revenue">
  									</td>
  									<td class="final-cost">
  										<span>&yen;</span>
  										<input type="hidden" value="200" name="final_central_cost_{{ $l }}" class="cost-profit-input final cost">
  									</td>
                    <td class="final-expense">
                      <span>&yen;{{ $key->headoffice_expense }}</span>
                      <input type="hidden" value="{{ $key->headoffice_expense }}" name="final_central_expense_{{ $l }}" class="expense-input final expense">
                    </td>
  									<td class="final-profit">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit" name="final_central_profit_{{ $l }}">
  									</td>
  									<td class="final-profit-rate">
  										<span>%</span>
  										<input type="hidden" class="final hidden-profit-rate" name="final_central_profitRate_{{ $l }}">
  									</td>
  									<td class="final-profit-gap">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit-gap" name="final_central_profitGap_{{ $l }}">
  									</td>
                    @else
                      <td class="final-sale">
  										<span>&yen;{{ $location_final_central[$l-1]->revenue }}</span>
  										<input type="hidden" value="{{ $location_final_central[$l-1]->revenue }}" name="final_central_revenue_{{ $l }}" class="revenue-profit-input final revenue">
  									</td>
  									<td class="final-cost">
  										<span>&yen;{{ $location_final_central[$l-1]->cost }}</span>
  										<input type="hidden" value="{{ $location_final_central[$l-1]->cost }}" name="final_central_cost_{{ $l }}" class="cost-profit-input final cost">
  									</td>
                    <td class="final-expense">
                      <span>&yen;{{ $key->headoffice_expense }}</span>
                      <input type="hidden" value="{{ $key->headoffice_expense }}" name="final_central_expense_{{ $l }}" class="expense-input final expense">
                    </td>
  									<td class="final-profit">
  										<span>&yen;{{ $location_final_central[$l-1]->profit }}</span>
  										<input type="hidden" value="{{ $location_final_central[$l-1]->profit }}" class="final hidden-profit" name="final_central_profit_{{ $l }}">
  									</td>
  									<td class="final-profit-rate">
  										<span>{{ $location_final_central[$l-1]->profit_rate }}%</span>
  										<input type="hidden" value="{{ $location_final_central[$l-1]->profit_rate }}" class="final hidden-profit-rate" name="final_central_profitRate_{{ $l }}">
  									</td>
  									<td class="final-profit-gap">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit-gap" name="final_central_profitGap_{{ $l }}">
  									</td>
                    @endif


  								</tr>
  								@endforeach
  								<tr class="subtotal">
  									<td>地区合計</td>
  									<td class="sub-sale">
  										<span></span>
  										<input type="hidden" class="company sub-sale-hidden" name="central_sub_sale">
  									</td>
  									<td class="sub-cost">
  										<span></span>
  										<input type="hidden" class="company sub-cost-hidden" name="central_sub_cost">
  									</td>
  									<td class="sub-expense">
  										<span>&yen;</span>
  										<input type="hidden" class="company sub-expense-hidden" name="central_sub_expense">
  									</td>
  									<td class="sub-profit">
  										<span></span>
  										<input type="hidden" class="company sub-profit-hidden" name="central_sub_profit">
  									</td>
  									<td class="sub-profit-rate">
  										<span></span>
  										<input type="hidden" class="company sub-rate-hidden" name="central_sub_profit_rate">
  									</td>
  									<td class="sub-setting-rate">
  										<span>%</span>
  										<input type="hidden" name="central_sub_setting_rate" class="company sub-setting-rate-hidden">
  									</td>

										@if (empty($sub_forecast_central[0]))
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
												&yen;
											</td>
											<td>
												%
											</td>
											@else
												<td>
													&yen;{{ $sub_forecast_central[0]->revenue }}
												</td>
												<td>
													&yen;{{ $sub_forecast_central[0]->cost }}
												</td>
												<td>
													&yen;{{ $sub_forecast_central[0]->headoffice_expense }}
												</td>
												<td>
													&yen;{{ $sub_forecast_central[0]->profit }}
												</td>
												<td>
													{{ $sub_forecast_central[0]->profit_rate }}%
												</td>
										@endif

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
  										&yen;
  									</td>
  									<td>
  										&yen;
  									</td>
  									<td>
  										&yen;
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
  						<hr>
  					</div>

  					<div class="indi-area">
  						<div class="area-heading">
  							<h2>
  								関西
  							</h2>
  						</div>
  						<table class="scroll">
  							<thead>
  								<tr>
  									<th style="background: transparent; padding-left: 30px;"></th>
  									<th style="background: #e74c3c; padding-left: 30px;" colspan="6">予算</th>
  									<th style="background: #2ecc71; padding-left: 30px;" colspan="5">予測</th>
  									<th style="background: #3498db; padding-left: 30px;" colspan="6">進捗</th>
  									<th style="background: #f1c40f; padding-left: 30px;" colspan="6">確定数値</th>
  								</tr>
  								<tr>
										<th>現場</th>
										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>目標引き上げ率</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>利益差</th>

										<th>売上</th>
										<th>原価</th>
										<th>本社費</th>
										<th>利益</th>
										<th>利益率</th>
										<th>利益差</th>

  								</tr>
  							</thead>
  							<tbody id="east">
  								@foreach ($area_east_budget as $key)
  								<tr class="record">
  									<td>{{ $key->location_name }}
  									<input type="hidden" name="area_east_location_{{ ++$k }}" value="{{ $key->location_name }}"></td>
  									<td class="company-sale">
  										<input type="text" value="{{ $key->revenue }}" name="area_east_revenue_{{ $k }}" ng-model="area_east_revenue_{{ $k }}" ng-init="area_east_revenue_{{ $k }}='{{ $key->revenue }}'" class="revenue-profit-input company revenue msg-id"  numbers-only my-maxlength="9">
  										<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
										<p class="custom-error err-req" style="display: none;">This field is required</p>
  									</td>
  									<td class="company-cost">
  										<input type="text" value="{{ $key->cost }}" name="area_east_cost_{{ $k }}" ng-model="area_east_cost_{{ $k }}" ng-init="area_east_cost_{{ $k }}='{{ $key->cost }}'" class="cost-profit-input company cost msg-id"  numbers-only my-maxlength="9">
  										<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
										<p class="custom-error err-req" style="display: none;">This field is required</p>
  									</td>
  									<td class="company-expense">
  										<input type="text" value="{{ $key->headoffice_expense }}" name="area_east_expense_{{ $k }}" ng-model="area_east_expense_{{ $k }}" ng-init="area_east_expense_{{ $k }}='{{ $key->headoffice_expense }}'" class="expense-input company expense mg-id"  numbers-only my-maxlength="9">
  										<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
										<p class="custom-error err-req" style="display: none;">This field is required</p>
  									</td>
  									<td class="company-profit">
  										<span>&yen;{{ $key->profit }}</span>
  										<input type="hidden" value="{{ $key->profit }}" class="company hidden-profit" name="area_east_profit_{{ $k }}">
  									</td>
  									<td class="company-profit-rate">
  										<span>{{ $key->profit_rate }}%</span>
  										<input type="hidden" value="{{ $key->profit_rate }}" class="company hidden-profit-rate" name="area_east_profitRate_{{ $k }}">
  									</td>
  									<td class="company-setting-rate">
  										<input type="text" value="{{ $key->setting_rate }}" name="area_east_settingRate_{{ $k }}" ng-model="area_east_settingRate_{{ $k }}" ng-init="area_east_settingRate_{{ $k }}='{{ $key->setting_rate }}'" class="setting-rate-box company msg-id" numbers-only my-maxlength="9" valid-rate> %
  										<p class="custom-error err-lim" style="display: none;">Allow only nine digits</p>
										<p class="custom-error err-req" style="display: none;">This field is required</p>
  									</td>

                    @if (empty($location_forecast_east[0]))
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
  										&yen;
  									</td>
  									<td>
  										%
  									</td>
                    @else
                      <td>
  										&yen;{{ $location_forecast_east[$k-1]->revenue }}
  									</td>
  									<td>
  										&yen;{{ $location_forecast_east[$k-1]->cost }}
  									</td>
  									<td>
  										&yen;{{ $area_east_budget[$k-1]->headoffice_expense }}
  									</td>
  									<td>
  										&yen;{{ $location_forecast_east[$k-1]->profit }}
  									</td>
  									<td>
  										{{ $location_forecast_east[$k-1]->profit_rate }}%
  									</td>
                    @endif


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
  										&yen;
  									</td>
  									<td>
  										%
  									</td>
  									<td>
  										&yen;
  									</td>
                    @if (empty($location_final_east[0]))
                      <td class="final-sale">
  										<span>&yen;</span>
  										<input type="hidden" value="" name="final_east_revenue_{{ $k }}" class="revenue-profit-input final revenue">
  									</td>
  									<td class="final-cost">
  										<span>&yen;</span>
  										<input type="hidden" value="" name="final_east_cost_{{ $k }}" class="cost-profit-input final cost">
  									</td>
                    <td class="final-expense">
                      <span>&yen;{{ $key->headoffice_expense }}</span>
                      <input type="hidden" value="{{ $key->headoffice_expense }}" name="final_east_expense_{{ $k }}" class="expense-input final expense">
                    </td>
  									<td class="final-profit">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit" name="final_east_profit_{{ $k }}">
  									</td>
  									<td class="final-profit-rate">
  										<span>%</span>
  										<input type="hidden" class="final hidden-profit-rate" name="final_east_profitRate_{{ $k }}">
  									</td>
  									<td class="final-profit-gap">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit-gap" name="final_west_profitGap_{{ $k }}">
  									</td>
                    @else
                      <td class="final-sale">
  										<span>&yen;{{ $location_final_east[$k-1]->revenue }}</span>
  										<input type="hidden" value="{{ $location_final_east[$k-1]->revenue }}" name="final_east_revenue_{{ $k }}" class="revenue-profit-input final revenue">
  									</td>
  									<td class="final-cost">
  										<span>&yen;{{ $location_final_east[$k-1]->cost }}</span>
  										<input type="hidden" value="{{ $location_final_east[$k-1]->cost }}" name="final_east_cost_{{ $k }}" class="cost-profit-input final cost">
  									</td>
                    <td class="final-expense">
                      <span>&yen;{{ $key->headoffice_expense }}</span>
                      <input type="hidden" value="{{ $key->headoffice_expense }}" name="final_east_expense_{{ $k }}" class="expense-input final expense">
                    </td>
  									<td class="final-profit">
  										<span>&yen;{{ $location_final_east[$k-1]->profit }}</span>
  										<input type="hidden" value="{{ $location_final_east[$k-1]->profit }}" class="final hidden-profit" name="final_east_profit_{{ $k }}">
  									</td>
  									<td class="final-profit-rate">
  										<span>{{ $location_final_east[$k-1]->profit_rate }}%</span>
  										<input type="hidden" value="{{ $location_final_east[$k-1]->profit_rate }}" class="final hidden-profit-rate" name="final_east_profitRate_{{ $k }}">
  									</td>
  									<td class="final-profit-gap">
  										<span>&yen;</span>
  										<input type="hidden" class="final hidden-profit-gap" name="final_west_profitGap_{{ $k }}">
  									</td>
                    @endif
  								</tr>
  								@endforeach
  								<tr class="subtotal">
  									<td>地区合計</td>
  									<td class="sub-sale">
  										<span></span>
  										<input type="hidden" class="company sub-sale-hidden" name="east_sub_sale">
  									</td>
  									<td class="sub-cost">
  										<span></span>
  										<input type="hidden" class="company sub-cost-hidden" name="east_sub_cost">
  									</td>
  									<td class="sub-expense">
  										<span>&yen;</span>
  										<input type="hidden" class="company sub-expense-hidden" name="east_sub_expense">
  									</td>
  									<td class="sub-profit">
  										<span></span>
  										<input type="hidden" class="company sub-profit-hidden" name="east_sub_profit">
  									</td>
  									<td class="sub-profit-rate">
  										<span></span>
  										<input type="hidden" class="company sub-rate-hidden" name="east_sub_profit_rate">
  									</td>
  									<td class="sub-setting-rate">
  										<span>%</span>
  										<input type="hidden" class="company sub-setting-rate-hidden" name="east_sub_setting_rate">
  									</td>

										@if (empty($sub_forecast_east[0]))
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
												&yen;
											</td>
											<td>
												%
											</td>
											@else
												<td>
													&yen;{{ $sub_forecast_east[0]->revenue }}
												</td>
												<td>
													&yen;{{ $sub_forecast_east[0]->cost }}
												</td>
												<td>
													&yen;{{ $sub_forecast_east[0]->headoffice_expense }}
												</td>
												<td>
													&yen;{{ $sub_forecast_east[0]->profit }}
												</td>
												<td>
													{{ $sub_forecast_east[0]->profit_rate }}%
												</td>
										@endif

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
  										&yen;
  									</td>
  									<td>
  										&yen;
  									</td>
  									<td>
  										&yen;
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
  						<hr>
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
	  								<th>Setting Rate</th>
	  							</tr>
  							</thead>
	  						<tbody>
	  							<tr>
	  								<td>全国合計</td>
	  								<td class="gross-sale">
	  									<span>&yen;</span>
	  									<input type="hidden" value="" name="gross_sale" class="gross-sale-hidden">
	  								</td>
	  								<td class="gross-cost">
	  									<span>&yen;</span>
	  									<input type="hidden" value="" name="gross_cost" class="gross-cost-hidden">
	  								</td>
	  								<td class="gross-expense">
	  									<span>&yen;</span>
	  									<input type="hidden" value="" name="gross_expense" class="gross-expense-hidden">
	  								</td>
	  								<td class="gross-profit">
	  									<span>&yen;</span>
	  									<input type="hidden" value="" name="gross_profit" class="gross-profit-hidden">
	  								</td>
	  								<td class="gross-profit-rate">
	  									<span>&yen;</span>
	  									<input type="hidden" value="" name="gross_profit_rate" class="gross-profit-rate-hidden">
	  								</td>
	  								{{-- <td class="gross-setting-rate">
	  									<span>&yen;</span>
	  									<input type="hidden" value="" name="gross-setting-rate" class="gross-setting-rate-hidden">
	  								</td> --}}

	  							</tr>
	  						</tbody>
  						</table>
  					</div>
  					<div class="submit-row">
              <button type="submit" class="btn-sumit">確定</button>
            </div>
				  </div>
				</form>
			</div>
		</div>
		@endif
	</body>
</html>
