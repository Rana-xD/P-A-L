
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
										'<option value="A"></option>'+
										tasksProcess +
										'<option vslue="R">Rest</option>'+
									'</select>'+
								'</div>'+
								'<div class="task">'+
									'<select name="hour_'+(i)+'_2" class="tasks-select">'+
										'<option value="A"></option>'+
										tasksProcess +
										'<option vslue="R">Rest</option>'+
									'</select>'+
								'</div>'+
								'<div class="task">'+
									'<select name="hour_'+(i)+'_3" class="tasks-select">'+
										'<option value="A"></option>'+
		                                tasksProcess+
		                                '<option vslue="R">Rest</option>'+
									'</select>'+
								'</div>'+
								'<div class="task">'+
									'<select name="hour_'+(i)+'_4" class="tasks-select">'+
										'<option value="A"></option>'+
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
				url = "/api/user/"+user,
				dates = $('#date_record').val();
				if($.trim(dates) == "" || dates == null){
					swal("Field Required","Date field required!", "error");
					return;
				}
			// Start ajax request
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'json',
				data:{_token:$('meta[name=csrf-token]').attr('content'),_date:dates},
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
					triggerBulkTimeInOut();
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

		// Validate minute
		function isValidMinute(eleObj){
			var validMinute = [0,15,30,45],
				validRestMinute = [0,15,30,45,60,75,90,105,120],
				val = $(eleObj).val();

			if($(eleObj).parent().is('.rest_minute')){
				if($.isNumeric(val) && (val.length ==2 || val.length ==3)){
					if($.inArray(parseInt(val),validRestMinute) > (-1)){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				if($.isNumeric(val) && val.length == 2){
					if($.inArray(parseInt(val),validMinute) > (-1)){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}

		}

		function isMaxHour(eleObj){
			var hour = $(this).parents('.time-group').find('.hour .time-input').val();
				if(hour>=36){
					return true;
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
			var value = $(instance).val();

			// Validate input time
			if(isMaxHour($(this))){
				notify('008');
				return;
			}

			var goodToGo = isValidMinute(instance);
			if($(instance).parent().is('.rest_minute')){
				if(!goodToGo){
					var val = parseInt(value) || 0;
					var floorVal = Math.floor((val+15) / 15) * 15;
					$(instance).val(floorVal>120 ? '00' : floorVal).change();
					notify('009');
					return;
				}

				value = parseInt(value);
				if(value <= 105){
					$(instance).val(parseInt(value)+15).change();
				}else{
					$(instance).val('00').change();
				}
			}else{
				if(!goodToGo){
					var val = parseInt(value) || 0;
					var floorVal = Math.floor((val+15) / 15) * 15;
					$(instance).val(floorVal>=60 ? '00' : floorVal).change();
					notify('007');
					return;
				}

				value = parseInt(value);
				if(value != 45){
					$(instance).val(parseInt(value)+15).change();
				}else{
					$(instance).val('00').change();
				}
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
			var value = $(instance).val();

			// validate time input
			var goodToGo = isValidMinute(instance);
			if($(instance).parent().is('.rest_minute')){
				if(!goodToGo){
					var val = parseInt(value) || 0;
					var floorVal = Math.floor((val+15) / 15) * 15;
					$(instance).val(floorVal>120 ? '00' : floorVal).change();
					notify('009');
					return;
				}


				value = parseInt(value);
				if(value !== 0 && value != 15){
					$(instance).val(value-15).change();
				}else if(value == 15){
					$(instance).val('00').change();
				}else{
					$(instance).val('120').change();
				}
			}else{
				if(!goodToGo){
					var val = parseInt(value) || 0;
					var floorVal = Math.floor((val+15) / 15) * 15;
					$(instance).val(floorVal>=60 ? '00' : floorVal).change();
					notify('007');
					return;
				}


				value = parseInt(value);
				if(value !== 0 && value != 15){
					$(instance).val(value-15).change();
				}else if(value == 15){
					$(instance).val('00').change();
				}else{
					$(instance).val('45').change();
				}
			}

		}

		// Listen on input time change event
		$(timeInput).donetyping(function(){

			var val = $(this).val() || 0;
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
				if($(this).parent().is('.rest_minute')){
					if(!isValidMinute($(this))){
						var value = parseInt(val) || 0;
						var floorVal = Math.floor((value+15) / 15) * 15;
						$(this).val(floorVal>120 ? '00' : floorVal);
						notify('009');
						taskVisibility();
						triggerBulkTimeInOut();
					}
				}else{
					if(!isValidMinute($(this))){
						var value = parseInt(val) || 0;
						var floorVal = Math.floor((value+15) / 15) * 15;
						$(this).val(floorVal>=60 ? '00' : floorVal);
						notify('007');
						taskVisibility();
						triggerBulkTimeInOut();
					}
				}
			}

			// Check if time in is before time out
			if(!isValidTimeRange()){
				var toVal = parseInt($(fromHour).val()) + 1;
				toVal < 10 ? toVal = '0'+toVal : toVal = toVal;
				$(toHour).val(toVal>36 ? '36' : toVal);
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

	switch(action){

		// Same task select shortcut @arg 0 string
		case '0' :
			var tin = ($('#bulk_action_time_in').val() || '6:00').split(':'),
				tout = ($('#bulk_action_time_out').val() || '6:00').split(':'),
				task = $('#bulk_action_tasks').val(),
				start = rangeHourToMinute(tin[0],tin[1]),
				stop = rangeHourToMinute(tout[0],tout[1]);

			$('#hours-range .task-hour .tasks-select')
			.slice(start,stop)
			.val(task);
			break;

		// Reset task shortcut @arg 1 string
		case '1' :
			$('#hours-range .task-hour')
			.find('.tasks-select')
			.val('A');
			break;

		default :
			console.log('default');
			break;

	}
}

// Trigger visibility task process
function taskVisibility(){
	var fromHour = $('.validate-hour-range #from-hour').find('.time-input').val() -6,
		fromMinute = $('.validate-hour-range #from-minute').find('.time-input').val(),
		toHour = $('.validate-hour-range #to-hour').find('.time-input').val() - 6,
		toMinute = $('.validate-hour-range #to-minute').find('.time-input').val();

	var start = ((((parseInt(fromHour) || 0) * 60) + (parseInt(fromMinute) || 0) + 15) / 15) -1;
	var stop = ((((parseInt(toHour) || 0) * 60) + (parseInt(toMinute) || 0) + 15) / 15) -1;
		$('#hours-range .task-hour .tasks-select')
		.removeClass('visible')
		.addClass('hide')
		.slice(start,stop)
		.removeClass('hide')
		.addClass('visible');

		$('#hours-range .task-hour .hide').val('A');
}

function rangeHourToMinute(hour,minute){
	var num = ((((parseInt(hour) -6 || 0) * 60) + (parseInt(minute) || 0) + 15) / 15) -1;
	return num;
}

// Initialize time in & out in bulk action
function triggerBulkTimeInOut(){
	var fromHour = $('.validate-hour-range #from-hour').find('.time-input').val(),
		fromMinute = $('.validate-hour-range #from-minute').find('.time-input').val(),
		toHour = $('.validate-hour-range #to-hour').find('.time-input').val(),
		toMinute = $('.validate-hour-range #to-minute').find('.time-input').val(),
		timeSet = "",
		strO = "00",
		start = ((parseInt(fromHour) - 6 || 0) * 60) + parseInt(fromMinute) || 0,
		stop = ((parseInt(toHour) - 6 || 0) * 60) + parseInt(toMinute) || 0,
		minu = 0,
		maxm = 45,
		jumpMinute = parseInt(fromMinute) || 0;
	for(var i=fromHour; i<=toHour; i++){
		if(i==7){jumpMinute=0}
		if(i==toHour){maxm=toMinute}
		for(var j=jumpMinute; j<=maxm; j+=15){
			minu = j!==0 ? j : "00";
			timeSet += '<option value="'+i+':'+minu+'">'+i+':'+minu+'</option>';
		}
	}

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
