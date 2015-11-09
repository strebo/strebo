app.controller('ConnectorBarController', ['$scope', function($scope) {
    $scope.networks = [{
        name: 'YouTube',
        icon: 'youtube',
        color: '#e52d27',
        status: 'connected',
        feed: [{
            text: "Cool Vid!"
        }]
    },{
        name: 'Twitter',
        icon: 'twitter',
        color: '#4099FF',
        status: 'disconnected',
        feed: [{
            text: "Hallo Welt!"
        }, {
            text: "From Twitter!"
        }]
    }, {
        name: 'Facebook',
        icon: 'facebook',
        color: '#3B5998',
        status: 'connected',
        feed: [{
            text: "Hallo Welt!"
        }, {
            text: "#Hashtag"
        }, {
            text: "From Facebook!"
        }]
    }];
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