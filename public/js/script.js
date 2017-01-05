
// Done typing plugin
;(function($){
    $.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function(el){
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                // thank you @palerdot
                $el.is(':input') && $el.on('keyup keypress paste',function(e){
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too preemptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type=='keyup' && e.keyCode!=8) return;

                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        // if we made it here, our timeout has elapsed. Fire the
                        // callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);

$(function(){

	// DOM query
	var addHourBtn = $('.increaseHour'),
		addMinuteBtn = $('.increaseMinute'),
		minusHourBtn = $('.decreaseHour'),
		minusMinuteBtn = $('.decreaseMinute'),
		timeInput = $('.time-input'),
		fromHour = $('#from-hour').find('.time-input'),
		toHour = $('#to-hour').find('.time-input');


	// Bind onclick for add and minus button
	$(addHourBtn).on('click', increaseHour);
	$(addMinuteBtn).on('click', increaseMinute);
	$(minusHourBtn).on('click', decreaseHour);
	$(minusMinuteBtn).on('click', decreaseMinute);

	// Listen on input time change event
	$(timeInput).donetyping(function(){

		if(!isValidTimeRange()){
			notify('006');
			return;
		}

		var val = $(this).val();
		if(!isNumisLength(val, val.length)){
			notify('001');
			return;
		}
		var mama = $(this).parent();

		delay(function(){

			// If parent of input is hour
			if($(mama).hasClass('hour')){
				if(!isMinMax(parseInt(val), 6, 36)){
					$(this).val('06');
					notify('004');
					return;
				}else{
					appendTask();
					return;
				}
			}

			// If parent is minute input
			if($(mama).hasClass('minute')){
				if(!isMinMax(val, 0, 59)){
					$(this).val('00');
					notify('005');
					return;
				}
				else{
					return;
				}
			}

		},200);

	}, 700);

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
			from = parseInt(fromHour.val());

		if(from > to){
			return false;
		}else{
			return true;
		}
	}

	// Increase hour input
	function increaseHour(){

		var instance = $(this).parents('.hour').find('.time-input');
		var value = instance.val();

		if(!isValidTimeRange()){
			notify('006');
			return;
		}

		var goodToGo = isNumisLength(value, value.length);
		if(!goodToGo === 'true'){
			notify(goodToGo);
			return;
		}

		value = parseInt(value);
		if(value < 36 && value >=9 ){
			instance.val(parseInt(value + 1));
		}else if(value<9){
			instance.val('0'+ parseInt(value + 1));
		}else{
			instance.val(parseInt('36'));
		}
		appendTask();

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
			instance.val(parseInt(value + 1));
		}else if(value<9){
			instance.val('0'+ parseInt(value + 1));
		}else{
			instance.val(parseInt('59'));
		}

	}

	// Decrease hour input
	function decreaseHour(){

		var instance = $(this).parents('.hour').find('.time-input');
		var value = instance.val();

		if(!isValidTimeRange()){
			notify('006');
			return;
		}

		// Validate time input
		var goodToGo = isNumisLength(value, value.length);
		if(!goodToGo === true){
			notify(goodToGo);
			return;
		}

		value = parseInt(value);
		if(value <= 10 && value >= 7){
			instance.val('0' + parseInt(value - 1));
		}else if(value > 10){
			instance.val(parseInt(value - 1));
		}

		appendTask();
		offsetHour();
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
			instance.val('0' + parseInt(value - 1));
		}else if(value > 10){
			instance.val(parseInt(value - 1));
		}


	}

	// Set offset hour range
	function offsetHour(){
		var startHour = parseInt(fromHour.val()),
			hoursRange = $('.hours-range');
			offset = startHour - 6;

			$(hoursRange).find('.task-hour').slice(0,offest).css({'visibility':'hidden'});
	}

	// Append task-hour to list
	function appendTask(){
		var startHour = parseInt(fromHour.val()),
			stopHour = parseInt(toHour.val()),
			tasksHour = stopHour - startHour,f
			hoursRange = $('.hours-range'),
			task_value = "my task";
			hoursRange.empty();
		for(i=0;i<tasksHour;i++){

			$(hoursRange).append(
				'<li class="task-hour">'+
					'<div class="tasks">'+
						'<div class="task">'+
							'<select name="hour_'+(i+6)+'_1" class="tasks-select">'+
								'<option></option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
							'</select>'+
						'</div>'+
						'<div class="task">'+
							'<select name="hour_'+(i+6)+'_2" class="tasks-select">'+
								'<option></option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
							'</select>'+
						'</div>'+
						'<div class="task">'+
							'<select name="hour_'+(i+6)+'_3" class="tasks-select">'+
								'<option></option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
							'</select>'+
						'</div>'+
						'<div class="task">'+
							'<select name="hour_'+(i+6)+'_4" class="tasks-select">'+
								'<option></option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
                                '<option value="'+task_value+'">Task hour'+ (i+6)+'</option>'+
							'</select>'+
						'</div>'+
					'</div>'+
				'</li>'
			);
		}


	}

});

// Notify
function notify(code, delay=3000){
	var ele = $('<span></span>');
	ele.addClass('notify');
	var text = "";

	// Show message base on code
	// @param code: define with switch case code
	switch(code){
		case '001':
			text = "time must be numeric and max length 2 digit!";
			ele.html(text);
			ele.addClass('error');
			$('body').append(ele);
			$(ele).animate({'top':'+=30px','opacity':'+=0.2'},350, function(){

				$(this).animate({'opacity':'1'},delay,function(){
					$(this).animate({'opacity':'-=0.2','top':'-=40px'},500,function(){
						$(this).remove();
					});
				});

			});
			break;

		case '002':
			text = "time length must be 2 digit!";
			ele.html(text);
			ele.addClass('error');
			$('body').append(ele);
			$(ele).animate({'top':'+=30px','opacity':'+=0.2'},350, function(){

				$(this).animate({'opacity':'1'},delay,function(){
					$(this).animate({'opacity':'-=0.2','top':'-=40px'},500,function(){
						$(this).remove();
					});
				});

			});
			break;

		case '003':
			text = "time must be numeric!";
			ele.html(text);
			ele.addClass('error');
			$('body').append(ele);
			$(ele).animate({'top':'+=30px','opacity':'+=0.2'},350, function(){

				$(this).animate({'opacity':'1'},delay,function(){
					$(this).animate({'opacity':'-=0.2','top':'-=40px'},500,function(){
						$(this).remove();
					});
				});

			});
			break;

		case '004':
			text = "hour must be min 06 and max 36!";
			ele.html(text);
			ele.addClass('error');
			$('body').append(ele);
			$(ele).animate({'top':'+=30px','opacity':'+=0.2'},350, function(){

				$(this).animate({'opacity':'1'},delay,function(){
					$(this).animate({'opacity':'-=0.2','top':'-=40px'},500,function(){
						$(this).remove();
					});
				});

			});
			break;

		case '005':
			text = "minute must be min 00 and max 59!";
			ele.html(text);
			ele.addClass('error');
			$('body').append(ele);
			$(ele).animate({'top':'+=30px','opacity':'+=0.2'},350, function(){

				$(this).animate({'opacity':'1'},delay,function(){
					$(this).animate({'opacity':'-=0.2','top':'-=40px'},500,function(){
						$(this).remove();
					});
				});

			});
			break;

		case '006':
			text = "Stop hour must greater than start hour!";
			ele.html(text);
			ele.addClass('error');
			$('body').append(ele);
			$(ele).animate({'top':'+=30px','opacity':'+=0.2'},350, function(){

				$(this).animate({'opacity':'1'},delay,function(){
					$(this).animate({'opacity':'-=0.2','top':'-=40px'},500,function(){
						$(this).remove();
					});
				});

			});
			break;

		default:
			return;
	}
}


// File upload
$(function(){
	var inputs = document.querySelectorAll( '.uploadfile' );
	Array.prototype.forEach.call( inputs, function( input )
	{
	  var label  = $(input).next(),
	    labelVal = $(label).html();

	  $(input).on( 'change', function( e )
	  {
	    var fileName = '';
	    if( this.files && this.files.length > 1 )
	      fileName = ( $(this).attr('data-multiple-caption') || '' ).replace( '{count}', this.files.length );
	    else
	      fileName = e.target.value.split( '\\' ).pop();

	    if(fileName)
	      $(label).html(fileName);
	    else
	      $(label).html(labelVal);
	  });
	});
});

//


$(document).ready(function(){
  var inputs = $('.multi-field');
  $(inputs).on('change', function(e) {

    var value = $(this).val();
    var price = $(this).attr('data-multiply-by');
    $(this).parent().next().find('span').html('&yen;'+ (value * price));
    $(this).parent().next().find('.total-uop').val(value * price);
  });
});
