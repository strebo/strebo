app.controller('LoaderController', ['$scope', 'DataService', '$sce', function($scope, DataService, $sce) {

}])
    .directive('loaderView', function() {
        return {
            restrict: 'E',
            templateUrl: '/js/LoaderView.html'
        };
    });