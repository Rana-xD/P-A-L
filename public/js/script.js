
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
                $el.is(':input') && $el.on('change keyup keypress paste',function(e){
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
			text = "Time in must before time out!";
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

		case '007':
			text = "Not a valid minute! <br/> Minute must 00, 15, 30, 45";
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

		case '008':
			text = "Maximum hour must not exceed 36!";
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

		case '009':
			text = "Valid rest minute is 0,15,30,45,60,75,90,105,120 ";
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
	Array.prototype.forEach.call( inputs, function( input ){
	  var label  = $(input).next(),
	    labelVal = $(label).html();

	  $(input).on( 'change', function( e ){
	    var fileName = '';
	    if( this.files && this.files.length > 1 ){
	      fileName = ( $(this).attr('data-multiple-caption') || '' ).replace( '{count}', this.files.length );
	    }
	    else{
	      fileName = e.target.value.split( '\\' ).pop();
	    }

	    if(fileName){
	      $(label).html(fileName);
	    }
	    else{
	      $(label).html(labelVal);
	    }
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

// Budget Management Page v.2.0
$(function(){

  $('.revenue, .cost, .expense').donetyping(function(){
    var sub;
    if($(this).hasClass('revenue')){
    	if($(this).hasClass('forecast')){
	      	// For manager page | forecast section
	      	var revenue = parseFloat($(this).val()) || 0;
	      	var cost = $.isNumeric($(this).parents('tr').find('.forecast.cost').val()) ? parseFloat($(this).parents('tr').find('.forecast.cost').val()) : 0;
	      	var expense = $.isNumeric($(this).parents('tr').find('.forecast.expense').val()) ? parseFloat($(this).parents('tr').find('.forecast.expense').val()) : 0;
	      	var profit = revenue - cost - expense;
	      	var profitRate = (profit * 100) / revenue;

	      	$(this).parents('tr').find('.forecast-profit span')
	      	.html('&yen;' + (profit).toFixed(2))
	      	.next().val((profit).toFixed(2));

	      	$(this).parents('tr').find('.forecast-profit-rate span')
	      	.html(parseFloat((profitRate).toFixed(2)) + '%')
	      	.next().val(parseFloat((profitRate).toFixed(2)));

	      	// Calculate profit gap in final
	      	var companyProfit = parseFloat($(this).parents('tr').find('.company.hidden-profit').val()) || 0;
	      	var finalProfit = parseFloat($(this).parents('tr').find('.final.hidden-profit').val()) || 0;
	      	var finalProfitGap = finalProfit - companyProfit;

	      	// Render value for profit gap | @final section
	      	$(this).parents('tr').find('.final-profit-gap span')
	      	.html('&yen;'+parseFloat((finalProfitGap).toFixed(2)))
	      	.next().val(parseFloat((finalProfitGap).toFixed(2)));

	    }else if($(this).hasClass('final')){
	   		// For Manager page | final section
	   	  	var revenue = parseFloat($(this).val()) || 0;
	      	var cost = $.isNumeric($(this).parents('tr').find('.final.cost').val()) ? parseFloat($(this).parents('tr').find('.final.cost').val()) : 0;
	      	var expense = $.isNumeric($(this).parents('tr').find('.final.expense').val()) ? parseFloat($(this).parents('tr').find('.final.expense').val()) : 0;
	      	var profit = revenue - cost - expense;
	      	var profitRate = (profit * 100) / revenue;


	      	// Render value for profit | @final section
	      	$(this).parents('tr').find('.final-profit span')
	      	.html('&yen;' + (profit).toFixed(2))
	      	.next().val((profit).toFixed(2));

	      	// Render value for profit rate | @final section
	      	$(this).parents('tr').find('.final-profit-rate span')
	      	.html(parseFloat((profitRate).toFixed(2)) + '%')
	      	.next().val(parseFloat((profitRate).toFixed(2)));

	      	// Calculate profit gap
	      	var profitGap = (profit - $(this).parents('tr').find('.company.hidden-profit').val());

	      	// Render value for profit gap | @final section
	      	$(this).parents('tr').find('.final-profit-gap span')
	      	.html('&yen;'+parseFloat((profitGap).toFixed(2)))
	      	.next().val(parseFloat((profitGap).toFixed(2)));

	    }else if($(this).hasClass('company')){
	   		// For admin page | forecast section
	   	  	var revenue = parseFloat($(this).val()) || 0;
	      	var cost = $.isNumeric($(this).parents('tr').find('.company.cost').val()) ? parseFloat($(this).parents('tr').find('.company.cost').val()) : 0;
	      	var expense = $.isNumeric($(this).parents('tr').find('.company.expense').val()) ? parseFloat($(this).parents('tr').find('.company.expense').val()) : 0;
	      	var profit = revenue - cost - expense;
	      	var profitRate = (profit * 100) / revenue;

	      	$(this).parents('tr').find('.company-profit span')
	      	.html('&yen;' + profit)
	      	.next().val(profit);

	      	$(this).parents('tr').find('.company-profit-rate span')
	      	.html(parseFloat((profitRate).toFixed(2)) + '%')
	      	.next().val(parseFloat((profitRate).toFixed(2)));

	      	// Calculate profit gap in final
	      	var companyProfit = parseFloat($(this).parents('tr').find('.company.hidden-profit').val()) || 0;
	      	var finalProfit = parseFloat($(this).parents('tr').find('.final.hidden-profit').val()) || 0;
	      	var finalProfitGap = finalProfit - companyProfit;

	      	// Render value for profit gap | @final section
	      	$(this).parents('tr').find('.final-profit-gap span')
	      	.html('&yen;'+parseFloat((finalProfitGap).toFixed(2)))
	      	.next().val(parseFloat((finalProfitGap).toFixed(2)));

	    }else{
	   		alert('error');
	    }

      // Calulate Sub Revenue
      calcSubTotal($(this));

    }else if($(this).hasClass('cost')){
   		if($(this).hasClass('forecast')){
   			// For manager page | forecast section
	        var revenue = $.isNumeric($(this).parents('tr').find('.forecast.revenue').val()) ? parseFloat($(this).parents('tr').find('.forecast.revenue').val()) : 0;
	    	var cost = parseFloat($(this).val()) || 0;
	    	var expense = $.isNumeric($(this).parents('tr').find('.forecast.expense').val()) ? parseFloat($(this).parents('tr').find('.forecast.expense').val()) : 0;
	    	var profit = revenue - cost - expense;
	    	var profitRate = (profit * 100) / revenue;

	      	$(this).parents('tr').find('.forecast-profit span')
	      	.html('&yen;' + (profit).toFixed(2))
	      	.next().val((profit).toFixed(2));

	      	$(this).parents('tr').find('.forecast-profit-rate span')
	      	.html(parseFloat((profitRate).toFixed(2)) + '%')
	      	.next().val(parseFloat((profitRate).toFixed(2)));

	      	// Calculate profit gap in final
	      	var companyProfit = parseFloat($(this).parents('tr').find('.company.hidden-profit').val()) || 0;
	      	var finalProfit = parseFloat($(this).parents('tr').find('.final.hidden-profit').val()) || 0;
	      	var finalProfitGap = finalProfit - companyProfit;

	      	// Render value for profit gap | @final section
	      	$(this).parents('tr').find('.final-profit-gap span')
	      	.html('&yen;'+parseFloat((finalProfitGap).toFixed(2)))
	      	.next().val(parseFloat((finalProfitGap).toFixed(2)));

   		}else if($(this).hasClass('final')){
   			// For Manager page | final section
	   		var revenue = $.isNumeric($(this).parents('tr').find('.final.revenue').val()) ? parseFloat($(this).parents('tr').find('.final.revenue').val()) : 0;
	      	var cost = parseFloat($(this).val()) || 0;
	      	var expense = $.isNumeric($(this).parents('tr').find('.final.expense').val()) ? parseFloat($(this).parents('tr').find('.final.expense').val()) : 0;
	      	var profit = revenue - cost - expense;
	      	var profitRate = (profit * 100) / revenue;

	      	// Render value for profit | @final section
	      	$(this).parents('tr').find('.final-profit span')
	      	.html('&yen;' + (profit).toFixed(2))
	      	.next().val((profit).toFixed(2));

	      	// Render value for profit rate | @final section
	      	$(this).parents('tr').find('.final-profit-rate span')
	      	.html(parseFloat((profitRate).toFixed(2)) + '%')
	      	.next().val(parseFloat((profitRate).toFixed(2)));

	      	// Calculate profit gap
	      	var profitGap = (profit - $(this).parents('tr').find('.company.hidden-profit').val());

	      	// Render value for profit gap | @final section
	      	$(this).parents('tr').find('.final-profit-gap span')
	      	.html('&yen;'+parseFloat((profitGap).toFixed(2)))
	      	.next().val(parseFloat((profitGap).toFixed(2)));

   		}else if($(this).hasClass('company')){
   			var revenue = $.isNumeric($(this).parents('tr').find('.company.revenue').val()) ? parseFloat($(this).parents('tr').find('.company.revenue').val()) : 0;
	      	var cost = parseFloat($(this).val()) || 0;
	      	var expense = $.isNumeric($(this).parents('tr').find('.company.expense').val()) ? parseFloat($(this).parents('tr').find('.company.expense').val()) : 0;
	      	var profit = revenue - cost - expense;
	      	var profitRate = (profit * 100) / revenue;

	      	$(this).parents('tr').find('.company-profit span')
	      	.html('&yen;' + profit)
	      	.next().val(profit);

	      	$(this).parents('tr').find('.company-profit-rate span')
	      	.html(parseFloat((profitRate).toFixed(2)) + '%')
	      	.next().val(parseFloat((profitRate).toFixed(2)));

	      	// Calculate profit gap in final
	      	var companyProfit = parseFloat($(this).parents('tr').find('.company.hidden-profit').val()) || 0;
	      	var finalProfit = parseFloat($(this).parents('tr').find('.final.hidden-profit').val()) || 0;
	      	var finalProfitGap = finalProfit - companyProfit;

	      	// Render value for profit gap | @final section
	      	$(this).parents('tr').find('.final-profit-gap span')
	      	.html('&yen;'+parseFloat((finalProfitGap).toFixed(2)))
	      	.next().val(parseFloat((finalProfitGap).toFixed(2)));

   		}else{
   			alert('error');
   		}

      // Calulate Sub Cost
      calcSubTotal($(this));

    }else if($(this).hasClass('expense')){
    	if($(this).hasClass('forecast')){
    		// For manager page | forecast section
	      	var revenue = $.isNumeric($(this).parents('tr').find('.forecast.revenue').val()) ? parseFloat($(this).parents('tr').find('.forecast.revenue').val()) : 0;
	      	var cost = $.isNumeric($(this).parents('tr').find('.forecast.cost').val()) ? parseFloat($(this).parents('tr').find('.forecast.cost').val()) : 0;
	      	var expense = parseFloat($(this).val()) || 0;
	      	var profit = revenue - cost - expense;
	      	var profitRate = (profit * 100) / revenue;

	      	$(this).parents('tr').find('.forecast-profit span')
	      	.html('&yen;' + (profit).toFixed(2))
	      	.next().val((profit).toFixed(2));

	      	$(this).parents('tr').find('.forecast-profit-rate span')
	      	.html(parseFloat((profitRate).toFixed(2)) + '%')
	      	.next().val(parseFloat((profitRate).toFixed(2)));

	      	// Calculate profit gap in final
	      	var companyProfit = parseFloat($(this).parents('tr').find('.company.hidden-profit').val()) || 0;
	      	var finalProfit = parseFloat($(this).parents('tr').find('.final.hidden-profit').val()) || 0;
	      	var finalProfitGap = finalProfit - companyProfit;

	      	// Render value for profit gap | @final section
	      	$(this).parents('tr').find('.final-profit-gap span')
	      	.html('&yen;'+parseFloat((finalProfitGap).toFixed(2)))
	      	.next().val(parseFloat((finalProfitGap).toFixed(2)));

    	}else if($(this).hasClass('final')){
    		// For Manager page | final section
	   		var revenue = $.isNumeric($(this).parents('tr').find('.final.revenue').val()) ? parseFloat($(this).parents('tr').find('.final.revenue').val()) : 0;
	      	var cost = $.isNumeric($(this).parents('tr').find('.final.cost').val()) ? parseFloat($(this).parents('tr').find('.final.cost').val()) : 0;
	      	var expense = parseFloat($(this).val()) || 0;
	      	var profit = revenue - cost - expense;
	      	var profitRate = (profit * 100) / revenue;


	      	// Render value for profit | @final section
	      	$(this).parents('tr').find('.final-profit span')
	      	.html('&yen;' + (profit).toFixed(2))
	      	.next().val((profit).toFixed(2));

	      	// Render value for profit rate | @final section
	      	$(this).parents('tr').find('.final-profit-rate span')
	      	.html(parseFloat((profitRate).toFixed(2)) + '%')
	      	.next().val(parseFloat((profitRate).toFixed(2)));

	      	// Caculate profit gap
	      	var profitGap = (profit - $(this).parents('tr').find('.company.hidden-profit').val());

	      	// Render value for profit gap | @final section
	      	$(this).parents('tr').find('.final-profit-gap span')
	      	.html('&yen;'+parseFloat((profitGap).toFixed(2)))
	      	.next().val(parseFloat((profitGap).toFixed(2)));

    	}else if($(this).hasClass('company')){
    	  	var revenue = $.isNumeric($(this).parents('tr').find('.company.revenue').val()) ? parseFloat($(this).parents('tr').find('.company.revenue').val()) : 0;
	      	var cost = $.isNumeric($(this).parents('tr').find('.company.cost').val()) ? parseFloat($(this).parents('tr').find('.company.cost').val()) : 0;
	      	var expense = parseFloat($(this).val()) || 0;
	      	var profit = revenue - cost - expense;
	      	var profitRate = (profit * 100) / revenue;

	      	$(this).parents('tr').find('.company-profit span')
	      	.html('&yen;' + profit)
	      	.next().val(profit);

	      	$(this).parents('tr').find('.company-profit-rate span')
	      	.html(parseFloat((profitRate).toFixed(2)) + '%')
	      	.next().val(parseFloat((profitRate).toFixed(2)));

	      	// Calculate profit gap in final
	      	var companyProfit = parseFloat($(this).parents('tr').find('.company.hidden-profit').val()) || 0;
	      	var finalProfit = parseFloat($(this).parents('tr').find('.final.hidden-profit').val()) || 0;
	      	var finalProfitGap = finalProfit - companyProfit;

	      	// Render value for profit gap | @final section
	      	$(this).parents('tr').find('.final-profit-gap span')
	      	.html('&yen;'+parseFloat((finalProfitGap).toFixed(2)))
	      	.next().val(parseFloat((finalProfitGap).toFixed(2)));

    	}else{
    		alert('error');
    	}

    	// Calculate Sub Expense
    	calcSubTotal($(this));

    }else{
    	alert('error');
    }

  }, 500);
});


// Calculate subtotal
function calcSubTotal(ele){
	var subDiv = $(ele).parents('tbody').find('tr.subtotal'),
	    sale=0,
	    cost=0,
	    expense=0,
	    profit=0,
	    profitRate=0,
	    finalProfitGap=0;
	if($(ele).hasClass('forecast')){

		// Sum total of each input
		sale = sum($(ele).parents('tbody').find('.forecast.revenue'));
		cost = sum($(ele).parents('tbody').find('.forecast.cost'));
		expense = sum($(ele).parents('tbody').find('.forecast.expense'));
		profit = sum($(ele).parents('tbody').find('.forecast.hidden-profit'));
		profitRate = sum($(ele).parents('tbody').find('.forecast.hidden-profit-rate'));
		// profitRate = (profit * 100) / sale;
		finalProfitGap = sum($(ele).parents('tbody').find('.final.hidden-profit-gap'));

		// Render html value & input hidden
		$(subDiv).find('.forecast-sub-sale span').html('&yen;'+sale).next().val(sale);
  		$(subDiv).find('.forecast-sub-cost span').html('&yen;'+cost).next().val(cost);
  		$(subDiv).find('.forecast-sub-expense span').html('&yen;'+expense).next().val(expense);
  		$(subDiv).find('.forecast-sub-profit span').html('&yen;'+profit).next().val(profit);
  		$(subDiv).find('.forecast-sub-profit-rate span').html(parseFloat((profitRate).toFixed(2)) + '%').next().val(parseFloat((profitRate).toFixed(2)));
  		$(subDiv).find('.final-sub-profit-gap span').html('&yen;'+parseFloat((finalProfitGap).toFixed(2))).next().val(parseFloat((finalProfitGap).toFixed(2)));

	}else if($(ele).hasClass('final')){

		// Sum total of each input
		sale = sum($(ele).parents('tbody').find('.final.revenue'));
		cost = sum($(ele).parents('tbody').find('.final.cost'));
		expense = sum($(ele).parents('tbody').find('.final.expense'));
		profit = sum($(ele).parents('tbody').find('.final.hidden-profit'));
		profitRate = (profit * 100) / sale;
		// profitRate = sum($(ele).parents('tbody').find('.final.hidden-profit-rate'));
		finalProfitGap = sum($(ele).parents('tbody').find('.final.hidden-profit-gap'));

		// Render html value & input hidden
		$(subDiv).find('.final-sub-sale span').html('&yen;'+sale).next().val(sale);
  		$(subDiv).find('.final-sub-cost span').html('&yen;'+cost).next().val(cost);
  		$(subDiv).find('.final-sub-expense span').html('&yen;'+expense).next().val(expense);
  		$(subDiv).find('.final-sub-profit span').html('&yen;'+profit).next().val(profit);
  		$(subDiv).find('.final-sub-profit-rate span').html(parseFloat((profitRate).toFixed(2)) + '%').next().val(parseFloat((profitRate).toFixed(2)));
  		$(subDiv).find('.final-sub-profit-gap span').html('&yen;'+parseFloat((finalProfitGap).toFixed(2))).next().val(parseFloat((finalProfitGap).toFixed(2)));

	}else if($(ele).hasClass('company')){
		sale = sum($(ele).parents('tbody').find('.company.revenue'));
		cost = sum($(ele).parents('tbody').find('.company.cost'));
		expense = sum($(ele).parents('tbody').find('.company.expense'));
		profit = sum($(ele).parents('tbody').find('.company.hidden-profit'));
		// profitRate = sum($(ele).parents('tbody').find('.company.hidden-profit-rate'));
		profitRate = ((profit * 100) / sale) / 1;
		finalProfitGap = sum($(ele).parents('tbody').find('.final.hidden-profit-gap'));


		// Render html value & input hidden
		$(subDiv).find('.sub-sale span').html('&yen;'+sale).next().val(sale);
  		$(subDiv).find('.sub-cost span').html('&yen;'+cost).next().val(cost);
  		$(subDiv).find('.sub-expense span').html('&yen;'+expense).next().val(expense);
  		$(subDiv).find('.sub-profit span').html('&yen;'+profit).next().val(profit);
  		$(subDiv).find('.sub-profit-rate span').html(parseFloat((profitRate).toFixed(2)) + '%').next().val(parseFloat((profitRate).toFixed(2)));
  		$(subDiv).find('.final-sub-profit-gap span').html('&yen;'+parseFloat((finalProfitGap).toFixed(2))).next().val(parseFloat((finalProfitGap).toFixed(2)));

	}else{

	}

  CalcGross();
}

function CalcGross(){
	var grossSale = 0,
		grossCost = 0,
		grossExpense = 0,
		grossProfit = 0,
		grossProfitRate = 0,
		grossProfitRate = 0,
		grossSettingRate =0;

	// Gross for sale
	$('.company.sub-sale-hidden').each(function(){
		grossSale = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(grossSale)) : parseFloat(grossSale);
	});

	// Gross for cost
	$('.company.sub-cost-hidden').each(function(){
		grossCost = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(grossCost)) : parseFloat(grossCost);
	});

	// Gross for expense
	$('.company.sub-expense-hidden').each(function(){
		grossExpense = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(grossExpense)) : parseFloat(grossExpense);	});

	// Gross for profit
	$('.company.sub-profit-hidden').each(function(){
		grossProfit = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(grossProfit)) : parseFloat(grossProfit);
	});

	// Gross for profit rate
	$('.company.sub-rate-hidden').each(function(){
		grossProfitRate = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(grossProfitRate)) : parseFloat(grossProfitRate);
	});

	// Gross for setting rate
	$('.company.sub-setting-rate-hidden').each(function(){
		grossSettingRate = $.isNumeric($(this).val()) ? (parseFloat($(this).val()) + parseFloat(grossSettingRate)) : parseFloat(grossSettingRate);
	});

	// Render Gross Value

	$('.gross-sale').find('span').html('&yen;'+grossSale).next().val(grossSale);
	$('.gross-cost').find('span').html('&yen;'+grossCost).next().val(grossCost);
	$('.gross-expense').find('span').html('&yen;'+grossExpense).next().val(grossExpense);
	$('.gross-profit').find('span').html('&yen;'+grossProfit).next().val(grossProfit);
	$('.gross-profit-rate').find('span').html(grossProfitRate+'%').next().val(grossProfitRate);
	$('.gross-setting-rate').find('span').html(grossSettingRate+'%').next().val(grossSettingRate);

}

// Caculate sum data of input element
function sum(datas){
	var vals = $(datas).toArray();
	var len = vals.length,
		sum = 0;
	for(var i=0; i<len; i++){
		sum += parseFloat($(vals[i]).val()) || 0;
	}

	return sum;
}


// $(function(){

// 	var days_in_month = {
// 		'1':31,
// 		'2':28,
// 		'3':31,
// 		'4':30,
// 		'5':31,
// 		'6':30,
// 		'7':31,
// 		'8':31,
// 		'9':30,
// 		'10':31,
// 		'11':30,
// 		'12':31

// 	}

// 	var dateHeader = $('#date_header');
// 	var shiftRecord = $('#shift_record');

//   function determineLeapYear(year){
//     if((year % 4 == 0) && (year % 100 != 0) || (year % 400 == 0)){
//       days_in_month['2'] = 29
//     }else{
//       days_in_month['2'] = 28
//     }
//   }

// 	function changeDateHeader(){

// 		var year = $('#year').val();
// 		var month = $('#month').val();
// 		determineLeapYear(year);

// 		var dayLen = days_in_month[month];

// 		$(dateHeader)
// 		.empty()
// 		.append(
// 			'<th>No</th>' +
// 			'<th style="width:20%">Worker Name</th>'
// 		);
// 		for(var i=1; i<=dayLen; i++){
// 			$(dateHeader).append(
// 				'<th>'+i+'</th>'
// 			);
// 		}
// 	}

//   $('#location, #month, #year').on('change', function(){
//     	changeDateHeader();
// 		getWorkShift();
//   });

// 	// Ajax request to get workshift
// 	function getWorkShift(){

// 		// $.ajaxSetup({
//    // 		headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
// 		// });

// 		$.ajax({
// 			url: '/api/workshift',
// 			type: 'POST',
// 			dataType: 'json',
// 			data: {location:$("#location").val(),month:$("#month").val(),year:$("#year").val(),_token:$('meta[name=csrf-token]').attr('content') },
// 			success: function(response){
//         console.log(JSON.stringify(response));
// 				var staffs = response.staff;

// 				$(shiftRecord).empty();

// 				for(var i=0; i<staffs.length; i++){
// 					var staffHtml = '',
// 							selectHtml = '',
// 							recordHtml = '';

// 					staffHtml = '<tr>'+
// 						'<td>'+(i+1)+'</td>'+
// 						'<td>'+staffs[i].staff_name+'</td>';

// 					for(var j=0; j<staffs[i].work_shift.length; j++){
// 						if(staffs[i].work_shift[j] == 0){
// 							selectHtml = selectHtml + '<td>'+
// 								'<select class="sel-box">'+
// 									'<option selected="selected" value="0">X</option>'+
// 									'<option value="1">O</option>'+
// 								'</select>'+
// 							'</td>';
// 						}else{
// 							selectHtml = selectHtml +'<td>'+
// 								'<select class="sel-box">'+
// 									'<option value="0">X</option>'+
// 									'<option selected="selected" value="1">O</option>'+
// 								'</select>'+
// 							'</td>';
// 						}

// 					}

// 					recordHtml = staffHtml + selectHtml + '</tr>';
// 					$(shiftRecord).append(recordHtml);
// 					staffHtml = '';
// 					selectHtml = '';
// 					recordHtml = '';
// 				}

// 			},
// 			error: function(error){

// 			}
// 		});

// 	}

// 	changeDateHeader();
// 	getWorkShift();

// 	$('#ajaxBtn').on('click', function(){
// 		getWorkShift();
// 	});

// });
