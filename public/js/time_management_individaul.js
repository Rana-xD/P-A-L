
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
			// Start Ajax request users
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'json',
				data: {_token:$('meta[name=csrf-token]').attr('content')},
				success: function(response){
					console.log(JSON.stringify(response));
					var staffs = response.staff,
						process = response.process,
						tasksProcess;
					// Empty previous data
					$(staff_ele).empty()
					.append('<option hidden></option>');

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
										'<option hidden></option>'+
										tasksProcess +
									'</select>'+
								'</div>'+
								'<div class="task">'+
									'<select name="hour_'+(i)+'_2" class="tasks-select">'+
										'<option hidden></option>'+
										tasksProcess +
									'</select>'+
								'</div>'+
								'<div class="task">'+
									'<select name="hour_'+(i)+'_3" class="tasks-select">'+
										'<option hidden></option>'+
		                                tasksProcess+
									'</select>'+
								'</div>'+
								'<div class="task">'+
									'<select name="hour_'+(i)+'_4" class="tasks-select">'+
										'<option hidden></option>'+
		                                tasksProcess+
									'</select>'+
								'</div>'+
							'</div>'+
						'</li>'
						);
					}
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
					$(shiftSched_ele).append(
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
				},
				error: function(error){
					console.log(JSON.stringify(error));
				}
			});
		});
	})();

	// Trigger append task process
	(function tirggerTask(){
		
	})();
});