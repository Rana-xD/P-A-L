
/** 
 * AJAX request function in 
 * time management individaul
 * 27/01/2017
 * Version 1.0
 * Dexpertize Team | KIT
**/
$(function(){
	var workProcess = "";
	// Ajax Query list of user by location
	(function getUsersByLocation(){
		var staff_ele = $('#staff_list'),
			taskHour = $('#hours-range');
			
		$('#location').on('change',function(){
			var loc = $(this).val() || 0,
				url = "/api/location/"+loc+"/users";
			$('#shift_schedule').empty();
			// Start Ajax request users
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'json',
				data: {_token:$('meta[name=csrf-token]').attr('content')},
				success: function(response){
					console.log(JSON.stringify(response));
					$('#shift_schedule').empty();
					var staffs = response.staff,
						process = response.process,
						tasksProcess;
					// Empty previous data
					$(staff_ele).empty()
					.append(
						'<option></option>'
					);

					// Extract users & append to list
					for(var i=0, len=staffs.length; i<len; i++){
						$(staff_ele).append('<option value="'+staffs[i].id+'">'+staffs[i].staff_name+'</option>');
					}

					// Extract process 
					for(var i=0, len=process.length; i<len; i++){
						tasksProcess += '<option value="'+process[i].id+'">'+process[i].process_name+'</option>'
					}
					// Empty previous task
					$(taskHour).empty();
					// Append task to list
					for(var i=6; i<36; i++){
						$(taskHour)
						.append(
						'<li class="task-hour">'+
							'<div class="tasks">'+
								'<div class="task">'+
									'<select name="hour_'+(i)+'_1" class="tasks-select">'+
										'<option></option>'+
										tasksProcess +
										'<option vslue="R">Rest</option>'+
									'</select>'+
								'</div>'+
								'<div class="task">'+
									'<select name="hour_'+(i)+'_2" class="tasks-select">'+
										'<option></option>'+
										tasksProcess +
										'<option vslue="R">Rest</option>'+
									'</select>'+
								'</div>'+
								'<div class="task">'+
									'<select name="hour_'+(i)+'_3" class="tasks-select">'+
										'<option></option>'+
		                                tasksProcess+
		                                '<option vslue="R">Rest</option>'+
									'</select>'+
								'</div>'+
								'<div class="task">'+
									'<select name="hour_'+(i)+'_4" class="tasks-select">'+
										'<option></option>'+
		                                tasksProcess+
		                                '<option vslue="R">Rest</option>'+
									'</select>'+
								'</div>'+
							'</div>'+
						'</li>'
						);
					}

					$('#bulk_action_tasks')
					.empty()
					.append(
						'<option disabled="disabled" selected>Select task</option>'+
						tasksProcess+
						'<option vslue="R">Rest</option>'
					);

					taskVisibility();
				},
				error: function(error){
					console.log(JSON.stringify(error));
				}
			});
		});
	})();
	
	// Ajax request specific user information
	(function getUserInfo(){
		var shiftSched_ele = $('#shift_schedule');
		// Bind onchange event on staff list
		$('#staff_list').on('change', function(){
			var user = $(this).val(),
				url = "/api/user/"+user;
				
			// Start ajax request
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'json',
				data:{_token:$('meta[name=csrf-token]').attr('content')},
				success: function(response){
					console.log(JSON.stringify(response));
					// Empthy previous data
					$(shiftSched_ele).empty();
					// Extract user info @key : $time_in, $time_out, $minute
					$(shiftSched_ele)
					.append(
						'<table class="schedule_tb">'+
							'<thead>'+
								'<tr>'+
									'<th class="dark" colspan="3">Shift Schedule</th>'+
								'</tr>'+
								'<tr>'+
									'<th>Time in</th>'+
									'<th>Time out</th>'+
									'<th>Rest</th>'+
								'</tr>'+
							'</thead>'+
							'<tbody>'+
								'<tr>'+
									'<td>'+response.user[0].time_in+'</td>'+
									'<td>'+response.user[0].time_out+'</td>'+
									'<td>'+response.user[0].rest+'</td>'+
								'</tr>'+
							'</tbody>'+
						'</table>'
					);
					var startTime = (response.user[0].time_in).split(':'),
						endTime = (response.user[0].time_out).split(':');

					$('#from-hour .time-input').val(startTime[0]);
					$('#from-minute .time-input').val(startTime[1]);
					$('#to-hour .time-input').val(endTime[0]);
					$('#to-minute .time-input').val(endTime[1]);
					$('#rest_minute .time-input').val(response.user[0].rest);

					taskVisibility();
				},
				error: function(error){
					console.log(JSON.stringify(error));
				}
			});
		});
	})();

	

	// Time range input funtion
	(function(){
		// DOM query
		var addHourBtn = $('.increase.hour'),
			addMinuteBtn = $('.increase.minute'),
			minusHourBtn = $('.decrease.hour'),
			minusMinuteBtn = $('.decrease.minute'),
			timeInput = $('.validate-hour-range .time-input'),
			fromHour = $('.validate-hour-range #from-hour').find('.time-input'),
			toHour = $('.validate-hour-range #to-hour').find('.time-input')
			fromMinute = $('.validate-hour-range #from-minute').find('.time-input'),
			toMinute = $('.validate-hour-range #to-minute').find('.time-input');

		// Bind onclick for add and minus button
		$(addHourBtn).on('click', increaseHour);
		$(addMinuteBtn).on('click', increaseMinute);
		$(minusHourBtn).on('click', decreaseHour);
		$(minusMinuteBtn).on('click', decreaseMinute);

		// Check whether value between min and max
		function isMinMax(val, min, max){
			if(!(val >= min && val <= max)){
				return false;
			}

			return true;
		}

		// Check whether value is number and exactly length
		function isNumisLength(num,len){
			var code = "";
			if(!($.isNumeric(num)) || num.length != len){
				if(!($.isNumeric(num)) && num.length != len){
					code = '001';
					return code;
				}else if(num.length != len){
					code = '002';
					return code;
				}else{
					code = '003';
					return code;
				}
			}else{
				return true;
			}
		}

		// Validate start and stop time
		function isValidTimeRange(){
			var to = parseInt(toHour.val()),
				from = parseInt(fromHour.val()),
				from_minute = parseInt(fromMinute.val()),
				to_minute = parseInt(toMinute.val());

			if(from < to){
				return true;
			}else if(from == to){
				if(from_minute <= to_minute){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		// Increase hour input
		function increaseHour(){

			var instance = $(this).parents('.hour').find('.time-input'),
				value = instance.val(),
				val = 0,
				goodToGo = isNumisLength(value, value.length);
			if(!goodToGo === 'true'){
				notify(goodToGo);
				return;
			}

			value = parseInt(value);
			if(value < 36 && value >=9 ){
				$(instance).val(parseInt(value + 1)).change();
			}else if(value<9){
				instance.val('0'+ parseInt(value + 1)).change();
			}else{
				instance.val('06').change();
			}

			console.log($(instance).val());
		}

		// Increase minute input
		function increaseMinute(){

			var instance = $(this).parents('.minute').find('.time-input');
			var value = instance.val();

			// Validate input time
			var goodToGo = isNumisLength(value, value.length);
			if(!goodToGo === true){
				notify(goodToGo);
				return;
			}

			
			value = parseInt(value);
			if(value < 59 && value >=9 ){
				instance.val(parseInt(value + 1)).change();
			}else if(value<9){
				instance.val('0'+ parseInt(value + 1)).change();
			}else{
				instance.val('00').change();
			}

		}

		// Decrease hour input
		function decreaseHour(){

			var instance = $(this).parents('.hour').find('.time-input');

			var value = instance.val();
			// Validate time input
			var goodToGo = isNumisLength(value, value.length);
			if(!goodToGo === true){
				notify(goodToGo);
				return;
			}

			value = parseInt(value);
			if(value <= 10 && value >= 7){
				instance.val('0' + parseInt(value - 1)).change();

			}else if(value == 6){
				instance.val('36').change();
			}else if(value > 10){
				instance.val(parseInt(value - 1)).change();
			}

		}

		// Decrease minute input
		function decreaseMinute(){

			var instance = $(this).parents('.minute').find('.time-input');
			var value = instance.val();

			// validate time input
			var goodToGo = isNumisLength(value, value.length);
			if(!goodToGo === true){
				notify(goodToGo);
				return;
			}

			
			value = parseInt(value);
			if(value <= 10 && value >= 1){
				instance.val('0' + parseInt(value - 1)).change();
			}else if(value == 0){
				instance.val('59').change();
			}else if(value > 10){
				instance.val(parseInt(value - 1)).change();
			}

		}

		// Listen on input time change event
		$(timeInput).donetyping(function(){

			var val = $(this).val();
			var mama = $(this).parent();
			// If parent of input is hour
			if($(mama).hasClass('hour')){
				// Check if time is numeric & exact length
				var code = isNumisLength(val, 2);
				if(!code == true){
					$(this).val('06');
					notify(code);
					taskVisibility();
					triggerBulkTimeInOut();
					return;
				}

				// Check it's a minute range
				if(!isMinMax(parseInt(val), 6, 36)){
					$(this).val('06');
					notify('004');
					taskVisibility();
					triggerBulkTimeInOut();
					return;
				}
			}

			// If parent is minute input
			if($(mama).hasClass('minute')){

				// Check if time is numeric & exact length
				if(!isNumisLength(val, 2)){
					$(this).val('00');
					notify('001');
					taskVisibility();
					triggerBulkTimeInOut();
					return;
				}

				// Check it's a minute range
				if(!isMinMax(val, 0, 59)){
					$(this).val('00');
					notify('005');
					taskVisibility();
					triggerBulkTimeInOut();
					return;
				}
			}

			// Check if time in is before time out
			if(!isValidTimeRange()){
				var toVal = parseInt($(fromHour).val()) + 1;
				toVal < 10 ? toVal = '0'+toVal : toVal = toVal;
				$(toHour).val(toVal);
				notify('006');
				taskVisibility();
				triggerBulkTimeInOut();
				return;
			}

			taskVisibility();
			triggerBulkTimeInOut();

		}, 400);

	})();

	// Listen on bulk action option
	$('#bulk-action-select').on('change', function(){
		var opt = $(this).val();
		if(opt == 0){
			$('.bulk-reset-action').css({
				'display' : 'none',
			});

			$('.bulk-task-shortcut').css({
				'display' : 'block',
			});
		}else if(opt == 1){
			$('.bulk-task-shortcut').css({
				'display' : 'none',
			});

			$('.bulk-reset-action').css({
				'display' : 'block',
			});
		}
	});

	// Prevent action button from submit
	$('.preventSubmit').on('click', function(event){
		event.preventDefault();

	});
	// Prevent submit form with ENTER
	$(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	});

	taskVisibility();
	triggerBulkTimeInOut();
});

// Shortcut tasks trigger
function triggerShortcutTask(action){
	var start = $('#bulk_action_time_in').val() - 6,
		stop = $('#bulk_action_time_out').val() - 6,
		task = $('#bulk_action_tasks').val();
	switch(action){
		case '0' :
			$('#hours-range .task-hour')
			.slice(start,stop)
			.find('.tasks-select')
			.val(task);
			break;

		case '1' : 
			$('#hours-range .task-hour')
			.find('.tasks-select option')
			.prop("selected", false);
			break;

		default : 
			console.log('default');
			break;

	}
}

// Trigger append task process
function taskVisibility(){
	var fromHour = $('.validate-hour-range #from-hour').find('.time-input').val() -6,
		toHour = $('.validate-hour-range #to-hour').find('.time-input').val() - 6;
		$('#hours-range .task-hour')
		.css({'visibility':'hidden'})
		.slice(fromHour,toHour)
		.css({
			'visibility':'visible',
		});
}

// Trigger time in & out in bulk action
function triggerBulkTimeInOut(){
	var timeIn = parseInt($('#from-hour .time-input').val()),
		timeOut = parseInt($('#to-hour .time-input').val()),
		timeSet = "";
		console.log(timeIn+":"+timeOut);
	for(var i=timeIn; i<=timeOut; i++){
		timeSet += '<option value="'+i+'">'+i+':00</option>';
	}
	console.log(timeSet);
	$('#bulk_action_time_in')
	.empty()
	.append(
		'<option disabled="disabled" selected>From time</option>'+
		timeSet
	);

	$('#bulk_action_time_out')
	.empty()
	.append(
		'<option disabled="disabled" selected>To time</option>'+
		timeSet
	);
}