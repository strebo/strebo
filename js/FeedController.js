app.controller('FeedController', ['$scope', 'DataService', function($scope, DataService) {
    $scope.letterLimitAuthor = 15;
    $scope.feed = DataService.getPosts();
    console.log($scope.feed);
    }])
    .directive('feedView', function() {
        return {
            restrict: 'E',
            templateUrl: '/js/FeedView.html'
        };
    });