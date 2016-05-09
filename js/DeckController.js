app.controller('DeckController', ['$scope', 'DataService', function($scope, DataService) {
        $scope.networks = DataService.getPostsByNetwork();
        $scope.showDetailView = function(index, networkIndex) {
            $scope.$emit('setCurrentItemByNetwork', {
                index: index,
                networkIndex: networkIndex
            });
            $scope.$emit('setDetailView', true);
        };
    }])
    .directive('deckView', function() {
        return {
            restrict: 'E',
            templateUrl: '/js/DeckView.html'
        };
    });