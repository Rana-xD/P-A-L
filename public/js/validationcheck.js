var app = angular.module('app', []);

app.controller('MainCtrl', function($scope) {
    $scope.validLength = 4;
});

app.directive('myMaxlength', ['$compile', '$log', function($compile, $log) {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function (scope, elem, attrs, ctrl) {
                attrs.$set("ngTrim", "false");
                var maxlength = parseInt(attrs.myMaxlength, 10);
                ctrl.$parsers.push(function (value) {
                $log.info("In parser function value = [" + value + "].");
                if (value.length > maxlength)
                {
                    $log.info("The value [" + value + "] is too long!");
                    value = value.substr(0, maxlength);
                    ctrl.$setViewValue(value);
                    ctrl.$render();
                    $log.info("The value is now truncated as [" + value + "].");
                }
                return value;
            });
        }
    };
}]);

app.directive('numbersOnly', function() {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, modelCtrl) {
            modelCtrl.$parsers.push(function(inputValue) {
                if (inputValue == undefined) return ''
                var onlyNumeric = inputValue.replace(/[^0-9]/g, '');
                if (onlyNumeric != inputValue) {
                    modelCtrl.$setViewValue(onlyNumeric);
                    modelCtrl.$render();
                }
                return onlyNumeric;
            });
        }
    };
});

app.directive('validRate', function() {
    return {
        require: '?ngModel',
        link: function(scope, element, attrs, ngModelCtrl) {
            if(!ngModelCtrl) {
                return; 
            }

            ngModelCtrl.$parsers.push(function(val) {
                if (angular.isUndefined(val)) {
                    var val = '';
                }
            
                var clean = val.replace(/[^-0-9\.]/g, '');
                var negativeCheck = clean.split('-');
                var decimalCheck = clean.split('.');
                if(!angular.isUndefined(negativeCheck[1])) {
                    negativeCheck[1] = negativeCheck[1].slice(0, negativeCheck[1].length);
                    clean =negativeCheck[0] + '-' + negativeCheck[1];
                    if(negativeCheck[0].length > 0) {
                        clean =negativeCheck[0];
                    }
                    
                }
                  
                if(!angular.isUndefined(decimalCheck[1])) {
                    decimalCheck[1] = decimalCheck[1].slice(0,2);
                    clean =decimalCheck[0] + '.' + decimalCheck[1];
                }

                if (val !== clean) {
                  ngModelCtrl.$setViewValue(clean);
                  ngModelCtrl.$render();
                }
                return clean;
            });

            element.bind('keypress', function(event) {
                if(event.keyCode === 32) {
                  event.preventDefault();
                }
            });
        }
    };
});

jQuery(document).ready(function($) {
    console.log("jQuery is ready to go");
    $('#error-submit').click(function(event) {
        $('html, body').animate({
            scrollTop: $('.input_form').find('.ng-invalid').first().offset().top
        }, 1000);

        $('.input_form').find('.date-err').parent().find('p').removeClass('ng-hide').addClass('ng-show');
        $('.input_form').find('.ng-invalid').first().addClass('warn');
    });

    $('#budget-error').click(function() {
        $('html, body').animate({
            scrollTop: $('.budget_form').find('.ng-invalid').first().offset().top
        }, 1000);

        $('.budget_form').find('.ng-invalid').first().addClass('warn').parent().find('.err-req').show();
    });

    $('.budget_form').find('.ng-invalid').keyup(function(event) {
        if ($(this).val()){
            $('.warn').removeClass('warn');
            $(this).parent().find('.err-req').hide();
        }
    });

    $('.datepicker').change(function(event) {
        console.log($('.datepicker').val());
        $('.warn').removeClass('warn');
        $(this).parent().find('p').removeClass('ng-show').addClass('ng-hide');
    });

    $('.input_form').find('.ng-valid').keyup(function(event) {
        console.log("test ng-valid press" + $(this).val().length);
        if ($(this).val().length == 5) {
            console.log("In if");
            $(this).parent().find('p').fadeIn(1000, function() {
                console.log("fadeIn");
                $(this).fadeOut(1000, function() {
                    console.log("fadeOut");
                });
            });
        }
    });

    $('.budget_form').find('.msg-id').keyup(function(event) {
        console.log("test ng-valid press" + $(this).val().length);
        if ($(this).val().length == 9) {
            console.log("In if");
            $(this).parent().find('.err-lim').fadeIn(1000, function() {
                console.log("fadeIn");
                $(this).fadeOut(1000, function() {
                    console.log("fadeOut");
                });
            });
        }
    });

});