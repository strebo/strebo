app.controller('SearchController', ['$scope', 'DataService', '$sce', function ($scope, DataService, $sce) {
        $scope.hideSearchView = function () {
            $scope.$emit('setSearchView', false);
        };

        $scope.search = function () {
            $scope.$emit('search', true);
        };

        $scope.enterSearch = function (e) {
            if (e.keyCode === 13) $scope.$emit('search', true);
        }

    }])
    .directive('searchView', function () {
        return {
            restrict: 'E',
            templateUrl: '/js/SearchView.html'
        };
    });