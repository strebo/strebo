app.controller('LoaderController', ['$scope', function($scope) {

}]).directive('loaderView', function() {
        return {
            restrict: 'E',
            templateUrl: '/js/LoaderView.html'
        };
    });