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
				$(function(){

					$('.revenue, .cost').donetyping(function(){
						var sub;
						if($(this).hasClass('revenue')){
							var revenue = parseFloat($(this).val());
							console.log($.isNumeric($(this).parents('tr').find('.cost').val()));
							var cost = $.isNumeric($(this).parents('tr').find('.cost').val()) ? parseFloat($(this).parents('tr').find('.cost').val()) : parseFloat('0.00');
							var profit = revenue - cost;
							var profitRate = (profit * 100) / revenue;
							console.log(revenue+":"+cost+":"+profit+":"+profitRate);

							$(this).parents('tr').find('.profit span').html('&yen;' + profit);
							$(this).parents('tr').find('.profit .hidden-profit').val(profit);

							$(this).parents('tr').find('.profit-rate span').html(parseFloat((profitRate).toFixed(2)) + '%');
							$(this).parents('tr').find('.profit-rate .hidden-profit-rate').val(parseFloat((profitRate).toFixed(2)));

							// Calulate subtotal
							calcSubTotal($(this));
						} else{
							var revenue = $.isNumeric($(this).parents('tr').find('.revenue').val()) ? parseFloat($(this).parents('tr').find('.revenue').val()) : parseFloat('0.00');
							var cost = parseFloat($(this).val());
							var profit = revenue - cost;
							var profitRate = (profit * 100) / revenue;
							console.log(revenue+":"+cost+":"+profit+":"+profitRate);
							$(this).parents('tr').find('.profit span').html('&yen;' + profit);
							$(this).parents('tr').find('.profit .hidden-profit').val(profit);

							$(this).parents('tr').find('.profit-rate span').html(parseFloat((profitRate).toFixed(2)) + '%');
							$(this).parents('tr').find('.profit-rate .hidden-profit-rate').val(parseFloat((profitRate).toFixed(2)));

							// Calulate subtotal
							calcSubTotal($(this));
						}


					}, 500);

					// Calculate subtotal
					function calcSubTotal(ele){
						var subDiv = $(ele).parents('tbody').find('tr.subtotal'),
							sale=0,
							cost=0,
							profit=0,
							profitRate=0;
						$(ele).parents('tbody').find('.revenue, .cost, .hidden-profit, .hidden-profit-rate').each(function(){

							// Found Revenue input
							if($(this).hasClass('revenue')){
								sale = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(sale)) : parseFloat(sale);

							}

							// Found cost input
							else if($(this).hasClass('cost')){
								cost = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(cost)) : parseFloat(cost);

							}

							// Found hidden-profit input
							else if($(this).hasClass('hidden-profit')){
								profit = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(profit)) : parseFloat(profit);

							}

							// Found profit rate input
							else{
								profitRate = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(profitRate)) : parseFloat(profitRate);

							}
						});

						$(subDiv).find('.sub-sale span').html('&yen;'+sale).next().val(sale);
						$(subDiv).find('.sub-cost span').html('&yen;'+cost).next().val(cost);
						$(subDiv).find('.sub-profit span').html('&yen;'+profit).next().val(profit);
						$(subDiv).find('.sub-profit-rate span').html(parseFloat((profitRate).toFixed(2)) + '%').next().val(parseFloat((profitRate).toFixed(2)));

					}

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
				<div style="margin-top: 20px">
					<label for="month">Select a month</label>
					<select id="month" style="margin-left: 5px; margin-right: 30px; width: 100px">
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
				</div>
				</br>
				<hr>

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
									<td>{{ $key->location_name }}</td>
									<td>
										<input type="text" value="" name="revenue" class="revenue-profit-input revenue">
									</td>
									<td>
										<input type="text" value="" name="cost" class="cost-profit-input cost">
									</td>
									<td class="profit">
										<span></span>
										<input type="hidden" class="hidden-profit" name="profit">
									</td>
									<td class="profit-rate">
										<span></span>
										<input type="hidden" class="hidden-profit-rate" name="profitRate">
									</td>
									<td>
										<input type="text" name="settingRate" class="setting-rate-box"> %
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
								@foreach ($area_west as $key)
								<tr class="record">
									<td>{{ $key->location_name }}</td>
									<td>
										<input type="text" value="" name="revenue" class="revenue-profit-input revenue">
									</td>
									<td>
										<input type="text" value="" name="cost" class="cost-profit-input cost">
									</td>
									<td class="profit">
										<span></span>
										<input type="hidden" class="hidden-profit" name="profit">
									</td>
									<td class="profit-rate">
										<span></span>
										<input type="hidden" class="hidden-profit-rate" name="profitRate">
									</td>
									<td>
										<input type="text" name="settingRate" class="setting-rate-box"> %
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
								@foreach ($area_west as $key)
								<tr class="record">
									<td>{{ $key->location_name }}</td>
									<td>
										<input type="text" value="" name="revenue" class="revenue-profit-input revenue">
									</td>
									<td>
										<input type="text" value="" name="cost" class="cost-profit-input cost">
									</td>
									<td class="profit">
										<span></span>
										<input type="hidden" class="hidden-profit" name="profit">
									</td>
									<td class="profit-rate">
										<span></span>
										<input type="hidden" class="hidden-profit-rate" name="profitRate">
									</td>
									<td>
										<input type="text" name="settingRate" class="setting-rate-box"> %
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
				</div>

			</div>
		</div>



	</body>
</html>
