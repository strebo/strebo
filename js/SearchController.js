app.controller('SearchController', ['$scope', 'DataService', '$sce', function($scope, DataService, $sce) {
    $scope.hideSearchView = function() {
       $scope.$emit('setSearchView',false);
    };

}])
    .directive('searchView', function() {
        return {
            restrict: 'E',
            templateUrl: '/js/SearchView.html'
        };
    });