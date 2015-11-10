app.controller('ConnectorBarController', ['$scope', 'DataService', function($scope, DataService) {
    $scope.networks = DataService.getNetworks();
}])
    .directive('connectorBar', function() {
        return {
            restrict: 'E',
            template: '<div id="social-network-connector-bar">'+
        '<div class="social-network-connector" ng-repeat="socialNetwork in networks">'+
            '<div class="center"><i class="fa fa-{{socialNetwork.icon}}"></i></div>'+
        '<div class="connector-status box-shadow {{socialNetwork.status}}"></div>'+
            '</div>'+
            '</div>'
            //templateUrl: 'FeedView.html'
        };
    });