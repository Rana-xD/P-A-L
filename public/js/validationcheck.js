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

app.directive('validFlaot', function() {
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

app.directive('requiredAny', function () {
    // Hash for holding the state of each group
    var groups = {};
    
    // Helper function: Determines if at least one control
    //                  in the group is non-empty
    function determineIfRequired(groupName) {
        var group = groups[groupName];
        if (!group) return false;
        
        var keys = Object.keys(group);
        return keys.every(function (key) {
            return (key === 'isRequired') || !group[key];
        });
    }
    
    return {
        restrict: 'A',
        require: '?ngModel',
        scope: {},   // an isolate scope is used for easier/cleaner
        // $watching and cleanup (on destruction)
        link: function postLink(scope, elem, attrs, modelCtrl) {
            // If there is no `ngModel` or no groupName has been specified,
            // then there is nothing we can do
            if (!modelCtrl || !attrs.requiredAny) return;
            
            // Get a hold on the group's state object
            // (if it doesn't exist, initialize it first)
            var groupName = attrs.requiredAny;
            if (groups[groupName] === undefined) {
                groups[groupName] = {isRequired: true};
            }
            var group = scope.group = groups[groupName];
            
            // Clean up when the element is removed
            scope.$on('$destroy', function () {
                delete(group[scope.$id]);
                if (Object.keys(group).length <= 1) {
                    delete(groups[groupName]);
                }
            });
            
            // Updates the validity state for the 'required' error-key
            // based on the group's status
            function updateValidity() {
                if (group.isRequired) {
                    modelCtrl.$setValidity('required', false);
                } else {
                    modelCtrl.$setValidity('required', true);
                }
            }
            
            // Updates the group's state and this control's validity
            function validate(value) {
                group[scope.$id] = !modelCtrl.$isEmpty(value);
                group.isRequired = determineIfRequired(groupName);
                updateValidity();
                return group.isRequired ? undefined : value;
            };
            
            // Make sure re-validation takes place whenever:
            //   either the control's value changes
            //   or the group's `isRequired` property changes
            modelCtrl.$formatters.push(validate);
            modelCtrl.$parsers.unshift(validate);
            scope.$watch('group.isRequired', updateValidity);
        }
    };
});


jQuery(document).ready(function($) {
    console.log("jQuery is ready to go");
    $('#error-submit').click(function(event) {
        $('html, body').animate({
            scrollTop: $('.input_form').find('.ng-invalid').first().offset().top
        }, 1000);

        $('.input_form').find('.ng-invalid').parent().find('.date-err').removeClass('ng-hide').addClass('ng-show');
        $('.input_form').find('.ng-invalid').parent().find('.datepicker').addClass('warn');
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
        $(this).parent().find('.date-err').removeClass('ng-show').addClass('ng-hide');
        $('#error-submit').click(function(event) {
            $('.input_form').find('.ng-invalid-required').parent().find('.err-req').show();
            $('.input_form').find('.ng-invalid-required').keyup(function(event) {
                if ($(this).val() == '') {
                    $('.input_form').find('.ng-invalid-required').parent().find('.err-req').show();
                } else {
                    $('.input_form').find('.ng-valid-required').parent().find('.err-req').hide();
                }
            });
        });
    });

    $(':input').keyup(function(event) {
        console.log("test ng-valid press" + $(this).val().length);
        if ($(this).val().length == 5) {
            console.log("In if");
            $(this).parent().find('.five-dig').fadeIn(1000, function() {
                console.log("fadeIn");
                $(this).fadeOut(1000, function() {
                    console.log("fadeOut");
                });
            });
        }

        if ($(this).val().length == 10) {
            $(this).parent().find('.ten-dig').fadeIn(1000, function() {
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