app.controller('FeedController', ['$scope', 'DataService', function($scope, DataService) {
    $scope.letterLimitAuthor = 15;
    $scope.feed = DataService.getPosts();
    $scope.showDetailView = function(post) {
        $scope.$emit('setCurrentItem', post);
        $scope.$emit('setDetailView', true);
    };

    }])
    .directive('feedView', function() {
        return {
            restrict: 'E',
            templateUrl: '/js/FeedView.html'
        };
    });