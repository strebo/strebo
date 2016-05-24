app.controller('ConnectorTooltipController', ['$scope', 'DataService', function($scope) {
}]).directive('connectorTooltip', function() {
    return {
        restrict: 'E',
        templateUrl: '/js/ConnectorTooltipView.html'
    };
});