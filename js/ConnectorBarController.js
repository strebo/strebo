app.controller('ConnectorBarController', ['$scope', 'DataService', function($scope, DataService) {
    $scope.networks = DataService.getNetworks();
    $scope.connectors = connectors;
}]).directive('connectorBar', function() {
        return {
            restrict: 'E',
            templateUrl: '/js/ConnectorBarView.html'
        };
    });