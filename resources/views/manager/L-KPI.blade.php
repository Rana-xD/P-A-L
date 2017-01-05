<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>L-KPI dashboard</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
  <link rel="stylesheet" type="text/css" href="/fonts/font-awesome.css">
  <script src="/js/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"><\/script>')</script>
	<script src="/js/script.js"></script>
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
    <style type="text/css">

  		.table {
  			border-collapse: collapse;
  			table-layout: fixed;
  			width: 100%;
  			background: #f6f6f6;
  		}
  		tr:nth-child(odd) {
  				background: #e9e9e9;
  			}
  		th:first-child {
  			width: 40px;
  		}
  		th {
  			color: #ffffff;
  			background: #27ae60;
  			text-align: center;
        padding: 7px 4px;
  		}
  		td:first-child {
  			text-align: center;
  		}

      td{
        padding: 4px;
      }

  		td > input {
  			width: 40%;
        padding: 4px;
        border: 1px solid rgba(0,0,0,0.1);
        font-family: "Raleway", sans-serif;
        font-size: 15px;
        border-radius: 3px;
  		}

      td > input:focus{
        outline: 2px solid rgba(46, 204, 113,0.2);
      }

  		td:last-child,
      td.text-center {

  		text-align: center;
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

    <div class="container">
      <div class="content" style="margin-bottom: 50px">

          <div class="row">
              <div class="time-range">
                <div class="input-group">
                  <div class="from">
                    <div class="heading">
                      <h4>
                        Clock out time 1
                      </h4>
                    </div>
                      <div class="hour" id="from-hour">
                          <span class="increase increaseHour">
                              <i class="fa fa-plus"></i>
                          </span>
                          <input name="start-hour"
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
                          <input name="start-minute"
                                 type="text"
                                 class="time-input"
                                 value="00">
                          <span class="decrease decreaseMinute">
                              <i class="fa fa-minus"></i>
                          </span>
                      </div>
                  </div>
                </div>

                <div class="divider">
                  <h1>
                    ~
                  </h1>
                </div>

                <div class="input-group">
                  <div class="to">
                    <div class="heading">
                      <h4>
                        Clock out time 2
                      </h4>
                    </div>
                      <div class="hour" id="to-hour">
                          <span class="increase increaseHour">
                              <i class="fa fa-plus"></i>
                          </span>
                          <input name="stop-hour"
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
                          <input name="stop-minute"
                                 type="text"
                                 class="time-input"
                                 value="00">
                          <span class="decrease decreaseMinute">
                              <i class="fa fa-minus"></i>
                          </span>
                      </div>
                  </div>
                </div>

                <div class="divider sm-hide">
                  <h1>
                    ~
                  </h1>
                </div>

                <div class="input-group">
                  <div class="from">
                    <div class="heading">
                      <h4>
                        Clock out time 3
                      </h4>
                    </div>
                      <div class="hour" id="to-hour">
                          <span class="increase increaseHour">
                              <i class="fa fa-plus"></i>
                          </span>
                          <input name="stop-hour"
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
                          <input name="stop-minute"
                                 type="text"
                                 class="time-input"
                                 value="00">
                          <span class="decrease decreaseMinute">
                              <i class="fa fa-minus"></i>
                          </span>
                      </div>
                  </div>
                </div>

                <div class="divider">
                  <h1>
                    ~
                  </h1>
                </div>

                <div class="input-group">
                  <div class="to">
                    <div class="heading">
                      <h4>
                        Clock out time 4
                      </h4>
                    </div>
                      <div class="hour" id="to-hour">
                          <span class="increase increaseHour">
                              <i class="fa fa-plus"></i>
                          </span>
                          <input name="stop-hour"
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
                          <input name="stop-minute"
                                 type="text"
                                 class="time-input"
                                 value="00">
                          <span class="decrease decreaseMinute">
                              <i class="fa fa-minus"></i>
                          </span>
                      </div>
                  </div>
                </div>

              </div>
          </div>
      <div class="table-container">

        <table class="table table-sm">
          <tr>
            <th>No</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Sales</th>
          </tr>
          @foreach ($categories as $category)
            <tr>
              <td>{{ ++$i }}</td>
              <td>{{ $category->category_name }}</td>
              <td class="text-center"><input data-multiply-by="{{ $category->UOP }}" type="text" id="{{ $i }}" class="multi-field"></td>
              <td name="">
                <span></span>
                <input type="hidden" class="total-uop" name="total-uop-{{$i}}" value=""/>
              </td>
            </tr>
          @endforeach
          </table>

        <table class="table table-sm">
          <tr>
            <th>No</th>
            <th>Accident</th>
            <th>Quantity</th>
            <th style="visibility: hidden"></th>
          </tr>
          @foreach ($accidents as $accident)
            <tr>
              <td>{{ $accident->id }}</td>
              <td>{{ $accident->accident_type }}</td>
              <td class="text-center"><input type="text" name="accident-{{$accident->id}}"></td>
              <td style="border-left: none;"></td>
            </tr>
          @endforeach

        </table>

        <table class="table table-sm">
          <tr>
            <th>No</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Sales</th>
          </tr>
          @foreach ($categories as $category)
            <tr>
              <td>{{ ++$j }}</td>
              <td>{{ $category->category_name }}</td>
              <td class="text-center"><input type="text" name=""></td>
              <td><input type="text" name=""></td>
            </tr>
          @endforeach
          </table>
        <div class="submit-row">
          <div class="fileupload">
            <input id="filebtn" class="uploadfile" type="file" name="files" data-multiple-caption="{count} files selected" multiple />
            <label for="filebtn">Choose file</label>
          </div>
          <button type="button" class="btn-sumit">Done</button>
        </div>
      </div>
    </div>


  </body>
</html>
