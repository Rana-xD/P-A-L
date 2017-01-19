
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
	if($(timeInput).parents().hasClass('validate-hour-range')){
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

<<<<<<< HEAD


	}, 700);
=======
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
>>>>>>> ff9caa1c70e2f6e2f671e4f248a3ccc68bcb302e

		}, 700);
	}
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

$(function(){
  	var inputs = $('.categ_input');
  	$(inputs).each(function(){
  		if($(this).hasClass('auto_calc')){
  			$(this).donetyping(function(){

			    var value = $.trim($(this).val()),
			    	price = $(this).attr('data-multiply-by');
			    if(value == ""){
			    	$('[data-id="'+$(this).attr("data-pair-id")+'"]').prop('disabled', false);
			    	$(this).parent().next().find('span').html('').next().val('');
			    }else{
			    	$('[data-id="'+$(this).attr("data-pair-id")+'"]').prop('disabled', true);
			    	$(this).parent().next().find('span').html('&yen;'+ (value * price));
			    	$(this).parent().next().find('.total-uop').val(value * price);
			    }

			}, 500);
  		}else{
  			$(this).donetyping(function(){
  				var value = $.trim($(this).val());
  				if(!value == ""){
  					$('[data-id="'+$(this).attr("data-pair-id")+'"]')
  					.prop('disabled', true)
  					.parent().next().find('.total-uop')
  					.prop('disabled', true);
  				}
          //else{
  				// 	$('[data-id="'+$(this).attr("data-pair-id")+'"]')
  				//  		.prop('disabled', false)
  				//  		.parent().next().find('.total-uop')
  				//  		.prop('disabled', false);
  				// }
  				else{
  					var bro = $(this).parents('tr').find('[data-id="'+$(this).attr("data-id")+'"]').not(this);
  					console.log(bro);
  					if(bro.val() == ""){
  						$('[data-id="'+$(this).attr("data-pair-id")+'"]')
  						.prop('disabled', false)
  						.parent().next().find('.total-uop')
  						.prop('disabled', false);
  					}else{
  						$('[data-id="'+$(this).attr("data-pair-id")+'"]')
  						.prop('disabled', true)
  						.parent().next().find('.total-uop')
  						.prop('disabled', true);
  					}
  				}
  			}, 500);
  		}
  	});


});

// // Budget Management Page v.1
// $(function(){
// <<<<<<< HEAD
//   $('.revenue, .cost').donetyping(function(){
//     var sub;
//     if($(this).hasClass('revenue')){
//       var revenue = parseFloat($(this).val());
//       console.log($.isNumeric($(this).parents('tr').find('.cost').val()));
//       var cost = $.isNumeric($(this).parents('tr').find('.cost').val()) ? parseFloat($(this).parents('tr').find('.cost').val()) : parseFloat('0.00');
//       var profit = revenue - cost;
//       var profitRate = (profit * 100) / revenue;
//       console.log(revenue+":"+cost+":"+profit+":"+profitRate);
// =======
//   $('.revenue, .cost, .expense').donetyping(function(){
//     var sub;
//     if($(this).hasClass('revenue')){
//       var revenue = parseFloat($(this).val());
//       var cost = $.isNumeric($(this).parents('tr').find('.cost').val()) ? parseFloat($(this).parents('tr').find('.cost').val()) : parseFloat('0.00');
//       var expense = $.isNumeric($(this).parents('tr').find('.expense').val()) ? parseFloat($(this).parents('tr').find('.expense').val()) : parseFloat('0.00');
//       var profit = revenue - cost - expense;
//       var profitRate = (profit * 100) / revenue;
      
// >>>>>>> ff9caa1c70e2f6e2f671e4f248a3ccc68bcb302e

//       $(this).parents('tr').find('.profit span').html('&yen;' + profit);
//       $(this).parents('tr').find('.profit .hidden-profit').val(profit);

//       $(this).parents('tr').find('.profit-rate span').html(parseFloat((profitRate).toFixed(2)) + '%');
//       $(this).parents('tr').find('.profit-rate .hidden-profit-rate').val(parseFloat((profitRate).toFixed(2)));

// <<<<<<< HEAD
//       // Calulate subtotal
//       calcSubTotal($(this));
//     } else{
//       var revenue = $.isNumeric($(this).parents('tr').find('.revenue').val()) ? parseFloat($(this).parents('tr').find('.revenue').val()) : parseFloat('0.00');
//       var cost = parseFloat($(this).val());
//       var profit = revenue - cost;
// =======
//       // Calulate Sub Revenue
//       calcSubTotal($(this));
//     } else if($(this).hasClass('cost')){
//       var revenue = $.isNumeric($(this).parents('tr').find('.revenue').val()) ? parseFloat($(this).parents('tr').find('.revenue').val()) : parseFloat('0.00');
//       var cost = parseFloat($(this).val());
//       var expense = $.isNumeric($(this).parents('tr').find('.expense').val()) ? parseFloat($(this).parents('tr').find('.expense').val()) : parseFloat('0.00');
//       var profit = revenue - cost - expense;
// >>>>>>> ff9caa1c70e2f6e2f671e4f248a3ccc68bcb302e
//       var profitRate = (profit * 100) / revenue;
//       console.log(revenue+":"+cost+":"+profit+":"+profitRate);
//       $(this).parents('tr').find('.profit span').html('&yen;' + profit);
//       $(this).parents('tr').find('.profit .hidden-profit').val(profit);

//       $(this).parents('tr').find('.profit-rate span').html(parseFloat((profitRate).toFixed(2)) + '%');
//       $(this).parents('tr').find('.profit-rate .hidden-profit-rate').val(parseFloat((profitRate).toFixed(2)));

// <<<<<<< HEAD
//       // Calulate subtotal
//       calcSubTotal($(this));
// =======
//       // Calulate Sub Cost
//       calcSubTotal($(this));
//     }else{
// 	  var revenue = $.isNumeric($(this).parents('tr').find('.revenue').val()) ? parseFloat($(this).parents('tr').find('.revenue').val()) : parseFloat('0.00');
//       var cost = $.isNumeric($(this).parents('tr').find('.cost').val()) ? parseFloat($(this).parents('tr').find('.cost').val()) : parseFloat('0.00');
//       var expense = parseFloat($(this).val());
//       var profit = revenue - cost - expense;
//       var profitRate = (profit * 100) / revenue;
      
//       $(this).parents('tr').find('.profit span').html('&yen;' + profit);
//       $(this).parents('tr').find('.profit .hidden-profit').val(profit);

//       $(this).parents('tr').find('.profit-rate span').html(parseFloat((profitRate).toFixed(2)) + '%');
//       $(this).parents('tr').find('.profit-rate .hidden-profit-rate').val(parseFloat((profitRate).toFixed(2)));
//     	// Calculate Sub Expense
//     	calcSubTotal($(this));
// >>>>>>> ff9caa1c70e2f6e2f671e4f248a3ccc68bcb302e
//     }


//   }, 500);
// });

// <<<<<<< HEAD
// =======

// >>>>>>> ff9caa1c70e2f6e2f671e4f248a3ccc68bcb302e
// // Calculate subtotal
// function calcSubTotal(ele){
//   var subDiv = $(ele).parents('tbody').find('tr.subtotal'),
//     sale=0,
//     cost=0,
// <<<<<<< HEAD
//     profit=0,
//     profitRate=0;
//   $(ele).parents('tbody').find('.revenue, .cost, .hidden-profit, .hidden-profit-rate').each(function(){
// =======
//     expense=0,
//     profit=0,
//     profitRate=0;
//   $(ele).parents('tbody').find('.revenue, .cost, .expense, .hidden-profit, .hidden-profit-rate').each(function(){
// >>>>>>> ff9caa1c70e2f6e2f671e4f248a3ccc68bcb302e

//     // Found Revenue input
//     if($(this).hasClass('revenue')){
//       sale = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(sale)) : parseFloat(sale);

//     }
// <<<<<<< HEAD

//     // Found cost input
//     else if($(this).hasClass('cost')){
//       cost = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(cost)) : parseFloat(cost);

// =======

//     // Found cost input
//     else if($(this).hasClass('cost')){
//       cost = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(cost)) : parseFloat(cost);

//     }

//      // Found expense input
//     else if($(this).hasClass('expense')){
//       expense = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(expense)) : parseFloat(expense);

// >>>>>>> ff9caa1c70e2f6e2f671e4f248a3ccc68bcb302e
//     }

//     // Found hidden-profit input
//     else if($(this).hasClass('hidden-profit')){
//       profit = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(profit)) : parseFloat(profit);

//     }

//     // Found profit rate input
//     else{
//       profitRate = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(profitRate)) : parseFloat(profitRate);

//     }
//   });

//   $(subDiv).find('.sub-sale span').html('&yen;'+sale).next().val(sale);
//   $(subDiv).find('.sub-cost span').html('&yen;'+cost).next().val(cost);
// <<<<<<< HEAD
// =======
//   $(subDiv).find('.sub-expense span').html('&yen;'+expense).next().val(expense);
// >>>>>>> ff9caa1c70e2f6e2f671e4f248a3ccc68bcb302e
//   $(subDiv).find('.sub-profit span').html('&yen;'+profit).next().val(profit);
//   $(subDiv).find('.sub-profit-rate span').html(parseFloat((profitRate).toFixed(2)) + '%').next().val(parseFloat((profitRate).toFixed(2)));

// }
// <<<<<<< HEAD
// =======

// function CalcGross(){
// 	var subtotals = $('.sub-sale-hidden');
// }
// >>>>>>> ff9caa1c70e2f6e2f671e4f248a3ccc68bcb302e
