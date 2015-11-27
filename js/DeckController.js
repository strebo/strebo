app.controller('DeckController', ['$scope', 'DataService', function($scope, DataService) {
        $scope.networks = DataService.getPostsByNetwork();
        $scope.showDetailView = function(post, socialNetwork) {
            console.log(post);
            console.log(socialNetwork);
            post.socialNetwork = {};
            post.socialNetwork.color = socialNetwork.color;
            post.socialNetwork.icon = socialNetwork.icon;
            $scope.$emit('setCurrentItem', post);
            $scope.$emit('setDetailView', true);
        };
    }])
    .directive('deckView', function() {
        return {
            restrict: 'E',
            templateUrl: '/js/DeckView.html'
        };
    });