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
										<li><a href="kpi">L-KPI</a></li>
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
									<th style="background: #3498db; padding-left: 30px;" colspan="6">進捗</th>
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

									<th>Last Update</th>
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
								<tr>
									<td>Location 1</td>
									<td>
										&yen;10,000,000
									</td>
									<td>
										&yen; 14,000,000
									</td>
									<td>&yen;3,000,000</td>
									<td>20%</td>
									<td><input type="text" name="" class="setting-rate-box"> %</td>

									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
									</td>
									<td>
										&yen;3,000,000
									</td>
									<td>
										15%
									</td>

									<td>12/01/2017</td>
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
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
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
								<tr>
									<td>Location 2</td>
									<td>
										&yen;10,000,000
									</td>
									<td>
										&yen; 14,000,000
									</td>
									<td>&yen;3,000,000</td>
									<td>20%</td>
									<td><input type="text" name="" class="setting-rate-box"> %</td>

									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
									</td>
									<td>
										&yen;3,000,000
									</td>
									<td>
										15%
									</td>

									<td>12/01/2017</td>
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
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
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
								<tr>
									<td>Location N</td>
									<td>
										&yen;10,000,000
									</td>
									<td>
										&yen; 14,000,000
									</td>
									<td>&yen;3,000,000</td>
									<td>20%</td>
									<td><input type="text" name="" class="setting-rate-box"> %</td>

									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
									</td>
									<td>
										&yen;3,000,000
									</td>
									<td>
										15%
									</td>

									<td>12/01/2017</td>
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
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
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
								<tr>
									<td>Subtotal</td>
									<td>&yen;26,000,000</td>
									<td>&yen;21,500,000</td>
									<td>&yen;4,500,000</td>
									<td>17.31%</td>
									<td><input type="text" name="" class="setting-rate-box"> %</td>
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


									<th>Last Update</th>
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
								<tr>
									<td>Location 1</td>
									<td>
										&yen;10,000,000
									</td>
									<td>
										&yen; 14,000,000
									</td>
									<td>&yen;3,000,000</td>
									<td>20%</td>
									<td><input type="text" name="" class="setting-rate-box"> %</td>

									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
									</td>
									<td>
										&yen;3,000,000
									</td>
									<td>
										15%
									</td>

									<td>12/01/2017</td>
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
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
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
								<tr>
									<td>Location 2</td>
									<td>
										&yen;10,000,000
									</td>
									<td>
										&yen; 14,000,000
									</td>
									<td>&yen;3,000,000</td>
									<td>20%</td>
									<td><input type="text" name="" class="setting-rate-box"> %</td>

									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
									</td>
									<td>
										&yen;3,000,000
									</td>
									<td>
										15%
									</td>

									<td>12/01/2017</td>
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
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
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
								<tr>
									<td>Location N</td>
									<td>
										&yen;10,000,000
									</td>
									<td>
										&yen; 14,000,000
									</td>
									<td>&yen;3,000,000</td>
									<td>20%</td>
									<td><input type="text" name="" class="setting-rate-box"> %</td>

									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
									</td>
									<td>
										&yen;3,000,000
									</td>
									<td>
										15%
									</td>

									<td>12/01/2017</td>
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
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
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
								<tr>
									<td>Subtotal</td>
									<td>&yen;26,000,000</td>
									<td>&yen;21,500,000</td>
									<td>&yen;4,500,000</td>
									<td>17.31%</td>
									<td><input type="text" name="" class="setting-rate-box"> %</td>
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


									<th>Last Update</th>
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
								<tr>
									<td>Location 1</td>
									<td>
										&yen;10,000,000
									</td>
									<td>
										&yen; 14,000,000
									</td>
									<td>&yen;3,000,000</td>
									<td>20%</td>
									<td><input type="text" name="" class="setting-rate-box"> %</td>

									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
									</td>
									<td>
										&yen;3,000,000
									</td>
									<td>
										15%
									</td>

									<td>12/01/2017</td>
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
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
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
								<tr>
									<td>Location 2</td>
									<td>
										&yen;10,000,000
									</td>
									<td>
										&yen; 14,000,000
									</td>
									<td>&yen;3,000,000</td>
									<td>20%</td>
									<td><input type="text" name="" class="setting-rate-box"> %</td>

									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
									</td>
									<td>
										&yen;3,000,000
									</td>
									<td>
										15%
									</td>

									<td>12/01/2017</td>
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
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
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
								<tr>
									<td>Location N</td>
									<td>
										&yen;10,000,000
									</td>
									<td>
										&yen; 14,000,000
									</td>
									<td>&yen;3,000,000</td>
									<td>20%</td>
									<td><input type="text" name="" class="setting-rate-box"> %</td>

									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
									</td>
									<td>
										&yen;3,000,000
									</td>
									<td>
										15%
									</td>

									<td>12/01/2017</td>
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
										<input type="text" name="" class="cost-profit-input" placeholder="10,000,000">
									</td>
									<td>
										<input type="text" name="" class="cost-profit-input" placeholder="7,000,000">
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
								<tr>
									<td>Subtotal</td>
									<td>&yen;26,000,000</td>
									<td>&yen;21,500,000</td>
									<td>&yen;4,500,000</td>
									<td>17.31%</td>
									<td><input type="text" name="" class="setting-rate-box"> %</td>
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
