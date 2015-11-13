app.controller('DeckController', ['$scope', 'DataService', function($scope, DataService) {
        $scope.networks = DataService.getPostsByNetwork();
    }])
    .directive('deckView', function() {
        return {
            restrict: 'E',
            templateUrl: '/js/DeckView.html'
        };
    });