
/** 
 * AJAX request function in 
 * time management individaul
 * 27/01/2017
 * Version 1.0
 * Dexpertize Team | KIT
**/
$(function(){

	// Ajax Query list of user by location
	(function getUsersByLocation(){
		var staff_ele = $('#staff_list');
			
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
					var staffs = response.staff;
					// Empty previous data
					$(staff_ele).empty()
					.append('<option hidden></option>');

					// Extract users & append to list
					for(var i=0, len=staffs.length; i<len; i++){
						$(staff_ele).append('<option value="'+staffs[i].id+'">'+staffs[i].staff_name+'</option>');
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

				},
				error: function(error){

				}
			});
		});
	})();
});