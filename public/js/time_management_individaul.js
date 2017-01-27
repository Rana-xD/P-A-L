
/** 
 *jQuery Document Ready
 *AJAX request
**/
$(function(){
	function getUsersByLocation(){
		var loc = $('#location').val() || 0,
			staff_ele = $('#staff_list'),
			url = "/api/location/"+loc+"/user";

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
					$(staff_ele).append('<option value="'+staffs[i].id+'">'+staffs[i].name+'</option>');
				}
			},
			error: function(error){
				console.log(JSON.stringify(error));
			}
		});
	}
});