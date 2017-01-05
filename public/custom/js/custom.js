function dlgfade() {
    var whitebg = document.getElementById("white-background");
    var dlg = document.getElementById("dlgbox");
    whitebg.style.display = "none";
    dlg.style.display = "none";

    $('body,html').animate({
        scrollTop: 0
    }, 800);
    return true;
}

// uncheckable radio button for some radio button which is not require

(function ($) {
    $.fn.uncheckableRadio = function () {

        return this.each(function () {
            var radio = this;
                $('label[for="' + radio.id + '"]').add(radio).mousedown(function () {
                    $(radio).data('wasChecked', radio.checked);
                });

                $('label[for="' + radio.id + '"]').add(radio).click(function () {
                    if ($(radio).data('wasChecked'))
                        radio.checked = false;
                });
           });
    };
})(jQuery);

function showDialog() {
    var whitebg = document.getElementById("white-background");
    var dlg = document.getElementById("dlgbox");
    whitebg.style.display = "block";
    dlg.style.display = "block";

    var winWidth = window.innerWidth;
    var winHeight = window.innerHeight;

    dlg.style.left = (winWidth / 2) - 480 / 2 + "px";
    dlg.style.top = "150px";
}
$(document).ready(function() {

// validation for min and max value
$("#residence_months").bind("keyup keydown", function(){
    var amount = $(this).val();
    if (amount < 1 || amount > 12){
        $(".residence_months-error-message").html("1〜12からのみ整数を入力してください");
        $("#residence_months").css("border", "1px solid red");
    } else {
        $(".residence_months-error-message").html("");
        $("#residence_months").css("border", "1px solid green");
    }
});
$("#length_of_service_month").bind("keyup keydown", function(){
    var amount = $(this).val();
    if (amount < 1 || amount > 12){
        $(".length_of_service_month-error-message").html("1〜12からのみ整数を入力してください");
        $("#length_of_service_month").css("border", "1px solid red");
    } else {
        $(".length_of_service_month-error-message").html("");
        $("#length_of_service_month").css("border", "1px solid green");
    }
});
$("#jd_length_of_service_month").bind("keyup keydown", function(){
    var amount = $(this).val();
    if (amount < 1 || amount > 12){
        $(".jd_length_of_service_month-error-message").html("1〜12からのみ整数を入力してください");
        $("#jd_length_of_service_month").css("border", "1px solid red");
    } else {
        $(".jd_length_of_service_month-error-message").html("");
        $("#jd_length_of_service_month").css("border", "1px solid green");
    }
});
$("#applicant_lessee_birth_age").bind("keyup keydown", function(){
    var amount = $(this).val();
    if (amount < 1 || amount > 150){
        $(".applicant_lessee_birth_age-error-message").html("1〜150からのみ整数を入力してください");
        $("#applicant_lessee_birth_age").css("border", "1px solid red");
    } else {
        $(".applicant_lessee_birth_age-error-message").html("");
        $("#applicant_lessee_birth_age").css("border", "1px solid green");
    }
});
$("#emergency_first_contact_birth_age").bind("keyup keydown", function(){
    var amount = $(this).val();
    if (amount < 1 || amount > 150){
        $(".emergency_first_contact_birth_age-error-message").html("1〜150からのみ整数を入力してください");
        $("#emergency_first_contact_birth_age").css("border", "1px solid red");
    } else {
        $(".emergency_first_contact_birth_age-error-message").html("");
        $("#emergency_first_contact_birth_age").css("border", "1px solid green");
    }
});
$("#cp_emergency_first_contact_birth_age").bind("keyup keydown", function(){
    var amount = $(this).val();
    if (amount < 1 || amount > 150){
        $(".cp_emergency_first_contact_birth_age-error-message").html("1〜150からのみ整数を入力してください");
        $("#cp_emergency_first_contact_birth_age").css("border", "1px solid red");
    } else {
        $(".cp_emergency_first_contact_birth_age-error-message").html("");
        $("#cp_emergency_first_contact_birth_age").css("border", "1px solid green");
    }
});

 // for some unrequired radio button to be able to uncheck
 $('.uncheckableradio').uncheckableRadio();

 // for replace newline charcode in textarea input
 $("textarea").on('focus keyup change', function(){
 	
 });


 $("textarea").on("keypress", function(e) {
 	var code = e.keyCode ? e.keyCode : e.which;
    if (code==13 || code==10) {
        $(this).val($(this).val()+"\r");
    }
 });

 // for validate the input fields to input only numeric
 $(".numberonly").on("keypress keyup blur",function (event) {    
       $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
  });
  
  //for those field that can contain float number
  $(".floatonly").on("keypress keyup blur",function (event) {
        //this.value = this.value.replace(/[^0-9\.]/g,'');
		$(this).val($(this).val().replace(/[^0-9\.]/g,''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
		}
  });
           

// disable for submitting form with ENTER key
$('form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});


// auto calculate the sum amount of input filed
$('.cash').change(function(){
    var total = 0;
    var instanceVal;
    $('.cash').each(function(){
        if($(this).val()=="" || $(this).val().trim()==""){
            instanceVal = 0;
        }else{
            instanceVal = parseFloat($(this).val());
        }
        total = total + instanceVal;
    });
    $('#totalcash').val(total);
});

$('#totalcash').change(function(){
    var total1 = 0;
    var instanceVal1;
    $('.cash').each(function(){
        if($(this).val()=="" || $(this).val().trim()==""){
            instanceVal1 = 0;
        }else{
            instanceVal1 = parseFloat($(this).val());
        }
        total1 = total1 + instanceVal1;
    });
    $('#totalcash').val(total1);
});


$('.cpcash').change(function(){
    var total = 0;
    var instanceVal;
    $('.cpcash').each(function(){
        if($(this).val()=="" || $(this).val().trim()==""){
            instanceVal = 0;
        }else{
            instanceVal = parseFloat($(this).val());
        }
        total = total + instanceVal;
    });
    $('#totalcpcash').val(total);
});

$('#totalcpcash').change(function(){
    var total1 = 0;
    var instanceVal1;
    $('.cpcash').each(function(){
        if($(this).val()=="" || $(this).val().trim()==""){
            instanceVal1 = 0;
        }else{
            instanceVal1 = parseFloat($(this).val());
        }
    });
    $('#totalcpcash').val(total1);
});


setTimeout(function(){
	$('.other-with-input').each(function(){
		if($(this).is(":checked")){
			$(this).parent().parent().find('.input-for-other').prop("disabled", false).css("display","block");
		}
	});
},500);
//toggle input text fields for some radio button that has filed to input (other radio button)
$('.input-for-other').prop("disabled", true).css("display","none");

$('.custom-radio-field').change(function(){
    if($(this).is(":checked")){
        if($(this).hasClass("other-with-input")){
            $(this).parent().parent().find('.input-for-other').prop("disabled", false).css("display","block");
        }else{
            $(this).parent().parent().find('.input-for-other').prop("disabled", true).css("display","none");
        }
    }else{
        $(this).parent().parent().find('.input-for-other').prop("disabled", true).css("display","none");
    }   
});


//Every checkboxes in the page
$('.pcheck input:checkbox').click(function() {
    $('.pcheck input:checkbox').not(this).prop('checked', false);
});                   
$('.ccheck input:checkbox').click(function() {
    $('.ccheck input:checkbox').not(this).prop('checked', false);
}); 
$('.ppcheck input:checkbox').click(function() {
    $('.ppcheck input:checkbox').not(this).prop('checked', false);
}); 
$('.cccheck input:checkbox').click(function() {
    $('.cccheck input:checkbox').not(this).prop('checked', false);
}); 
    $("input").each(
        function() {
           $(this).data('holder', $(this).attr('placeholder'));
        });
    $("input[name$='fomrRadio']").click(function() {
        var test = $(this).val();

        $("div.flipper").hide();
        $("#flip" + test).show(300);
    });

    $("#dis").click(function(e) {
    	// prevent the form submission
    	e.preventDefault();

    	$('input').each(function(){
    		$(this).attr("placeholder","");
    	});

        // disable the select input option
        $('select').css('pointerEvents','none');

    	$('#coperationForm').parent().css("display","none");

    	$('.custom-select').click(function(e){
    		e.preventDefault();
    		return false;
    	});

        $("select :selected").each(function(){
            $(this).parent().data("default", this);
        });

        $("select").change(function(e) {
            $($(this).data("default")).prop("selected", true);
        });
        
        // find radio input which is not checked then hide its parent div(inline-form-element)
        $('.custom-radio-field:not(:checked)').parent().css("display","none");

        $('.custom-checkbox-field:not(:checked)').parent().css("display","none");

        $('input[type="radio"]:checked').next().find('span').hide();

        $('input[type="checkbox"]:checked').hide();
        
        $('.btn-file').css("display","none");

        //$("input[class$='disabper']").prop("disabled", true);
        //$("select[class$='disabper']").prop("disbled", true);
        $("input[name$='disabper']").addClass( "custom-placeholder" );
        $('.disabper').prop("readonly", true);

        $('.fadei').toggle();
        $('#dis').fadeOut();
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
        });

    $("#disa").click(function(e) {
    	// prevent the form submission
    	e.preventDefault();

    	$('#personalForm').parent().css("display","none");

    	$('input').each(function(){
    		$(this).attr("placeholder","");
    	});

        // disable the select input option
        $('select').css('pointerEvents','none');

    	$('.custom-select').click(function(e){
    		e.preventDefault();
    		return false;
    	});

        $("select :selected").each(function(){
            $(this).parent().data("default", this);
        });

        $("select").change(function(e) {
            $($(this).data("default")).prop("selected", true);
        });
           
        // find radio input which is not checked then hide its parent div(inline-form-element)
        $('.custom-radio-field:not(:checked)').parent().css("display","none");

        $('.custom-checkbox-field:not(:checked)').parent().css("display","none");

        $('input[type="radio"]:checked').next().find('span').hide();

        $('input[type="checkbox"]:checked').hide();
        
        $('.btn-file').css("display","none");

        //$("input[class$='disabcop']").prop("disabled", true);
        //$("input[class$='disabcop']").prop("disabled", true);
        $('input:text').addClass( "custom-placeholder" );
        $('.disabcop').prop("readonly", true);

        $('.fadeicop').toggle();
        $('#disa').fadeOut();
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    $('#editcop').click(function(e) {
    	// prevent the form submission
    	e.preventDefault();

    	$('.custom-select').click(function(){
    		return true;
    	});

        // re-enable the select input option
        $('select').css('pointerEvents','auto');

    	$('input').each(function(){
    		$(this).attr("placeholder",$(this).data('holder'));
    	});

    	$('.form-tab .form-tab-list').css("display","block");

        $("select :selected").each(function(){
            $(this).parent().data("default", this);
        });

        $("select").change(function(e) {
            $($(this).data("default")).prop("selected", false);
        });
         
	    $('.custom-radio-field:not(:checked)').parent().css("display","block");

	    $('.custom-checkbox-field:not(:checked)').parent().css("display","inline-block");

	    $('input[type="radio"]:checked').next().find('span').show();

        $('input[type="checkbox"]:checked').show();

	    $('.btn-file').css("display","inline-block");

    	$('input:text').removeClass( "custom-placeholder" );
        $('.disabcop').prop("readonly", false);
        $('.fadeicop').toggle();
        $('#disa').fadeIn();
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    $('#edi').click(function(e) {
    	e.preventDefault();

    	$('input').each(function(){
    		$(this).attr("placeholder",$(this).data('holder'));
    	});

        // re-enable the select input option

        $('select').css('pointerEvents','auto');

    	$('.custom-select').click(function(){
    		return true;
    	});

    	$('.form-tab .form-tab-list').css("display","block");

        $("select :selected").each(function(){
            $(this).parent().data("default", this);
        });

        $("select").change(function(e) {
            $($(this).data("default")).prop("selected", false);
        });
         
        $('.custom-radio-field:not(:checked)').parent().css("display","block");

        $('.custom-checkbox-field:not(:checked)').parent().css("display","inline-block");

        $('input[type="radio"]:checked').next().find('span').show();

        $('input[type="checkbox"]:checked').show();

        $('.btn-file').css("display","inline-block");

    	$('input:text').removeClass( "custom-placeholder" );
        $('.disabper').prop("readonly", false);
        $('.fadei').toggle();
        $('#dis').fadeIn();
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

   function validationCtrl($scope) {
   var validUsername = "Thodoris Bais";
   var validEmail = "thodoris.bais@gmail.com";
   
   $scope.reset = function(){
        $scope.username = validUsername;
        $scope.email = validEmail;
   }   
   
   $scope.checkData = function() {
        if ($scope.username != validUsername || $scope.email != validEmail) {
            alert("The data provided do not match with the default owner");
        } else {
            alert("Seems to be ok!");
        }
    }
}
});
var inputQuantity = [];
    $(function() {
      $(".seven").each(function(i) {
        inputQuantity[i]=this.defaultValue;
         $(this).data("idx",i); // save this field's index to access later
      });
      $(".seven").on("keyup", function (e) {
        var $field = $(this),
            val=this.value,
            $thisIndex=parseInt($field.data("idx"),10); // retrieve the index
//        window.console && console.log($field.is(":invalid"));
          //  $field.is(":invalid") is for Safari, it must be the last to not error in IE8
        if (this.validity && this.validity.badInput || isNaN(val) || $field.is(":invalid") ) {
            this.value = inputQuantity[$thisIndex];
            return;
        } 
        if (val.length > Number($field.attr("maxlength"))) {
          val=val.slice(0, 5);
          $field.val(val);
        }
        inputQuantity[$thisIndex]=val;
      });      
    });




