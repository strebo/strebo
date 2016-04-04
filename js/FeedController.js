app.controller('FeedController', ['$scope', 'DataService', function($scope, DataService) {
    //$scope.letterLimitAuthor = 13;
    $scope.feed = DataService.getPosts();
    $scope.showDetailView = function(index) {
        $scope.$emit('setCurrentItem', index);
        $scope.$emit('setDetailView', true);
    };

    }])
    .directive('feedView', function() {
        return {
            restrict: 'E',
            templateUrl: '/js/FeedView.html'
        };
    });