app.controller('ConnectorBarController', ['$scope', 'DataService', function($scope, DataService) {
    /*DataService.getNetworks().then(function(networks) {
        $scope.networks = networks;
    });*/

    $scope.networks = DataService.getNetworks();
}])
    .directive('connectorBar', function() {
        return {
            restrict: 'E',
            templateUrl: '/js/ConnectorBarView.html'
        };
    });