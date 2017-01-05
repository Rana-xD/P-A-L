<!DOCTYPE html>
<html>
<head>
	<title>Work shift</title>
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
										<li><a href="kpi">L-KPI</a></li>
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
				<select style="margin-left: 1em; margin-right: 5em;">
					<option>Location 1</option>
					<option>Location 2</option>
					<option>Location 3</option>
					<option>Location 4</option>
					<option>Location 5</option>
					<option>Location 6</option>
					<option>Location 7</option>
					<option>Location 8</option>
					<option>Location 9</option>
					<option>Location 10</option>
				</select>
				Select month
				<select style="margin-left: 1em; margin-right: 5em">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
					<option>11</option>
					<option>12</option>
				</select>
				Select year
				<input type="year" name="year" style="margin-left: 1em; width: 100px">
				<br>
				<br>
			</div>
			<div>
				<table>
					<tr>
						<th>No</th>
						<th style="width: 15%;">Worker name</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
						<th>9</th>
						<th>10</th>
						<th>11</th>
						<th>12</th>
						<th>13</th>
						<th>14</th>
						<th>15</th>
						<th>16</th>
						<th>17</th>
						<th>18</th>
						<th>19</th>
						<th>20</th>
						<th>21</th>
						<th>22</th>
						<th>23</th>
						<th>24</th>
						<th>25</th>
						<th>26</th>
						<th>27</th>
						<th>28</th>
						<th>29</th>
						<th>30</th>
						<th>31</th>
					</tr>
					<tr>
						<td>1</td>
						<td>Worker 1</td>
						<td><select class="sel-box">
								<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Worker 2</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>3</td>
						<td>Worker 3</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>4</td>
						<td>Worker 4</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>5</td>
						<td>Worker 5</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>N</td>
						<td>Worker N</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
						<td><select class="sel-box">
						<option selected hidden></option>
								<option>x</option>
								<option>o</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<br>
			<br>
			<div>
				<div class="fileupload">
					<input id="file" class="uploadfile" type="file" name="files" data-multiple-caption="{count} files selected" multiple />
					<label for="file">Choose file</label>
				</div>

			</div>
		</div>
	</div>


</body>
</html>
