var app = angular.module('app', []);

app.controller('MainCtrl', function($scope) {
    $scope.validLength = 4;
});

app.directive('wmBlock', function($parse){
    return {
        scope: {
            wmBlockLength: '='
        },
        link: function(scope, element, attr) {
            element.bind('keypress', function(e) {
                if (element[0].value.length > scope.wmBlockLength) {
                    e.preventDefault();
                    return false;
                }
            });
        }
    }
});

app.directive('numbersOnly', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                	console.log("Input value :" + text.length);
                    var transformedInput = text.replace(/[^0-9]/g, '');

                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return undefined;
            }            
            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});