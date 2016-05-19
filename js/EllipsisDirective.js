app.directive('ellipsis', [
    "$log", "$timeout", function ($log, $timeout) {
        return {
            restrict: 'A',
            scope: false,
            link: function (scope, element) {

                // let the angular data binding run first
                $timeout(function() {
                    element.dotdotdot({
                        watch: "window",
                        wrap: 'letter'
                    });
                });
            }
        };
    }
]);
