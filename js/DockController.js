app.controller('DockController', ['$scope', function($scope) {
        $scope.networks = [{
            name: 'Twitter',
            icon: 'twitter',
            feed: [{
                text: "Hallo Welt!"
            }, {
                text: "From Twitter!"
            }]
        }, {
            name: 'Facebook',
            icon: 'facebook',
            feed: [{
                text: "Hallo Welt!"
            }, {
                text: "From Facebook!"
            }]
        }];
    }])
    .directive('dockView', function() {
        return {
            restrict: 'E',
            template: '<div class="social-media-content-container box-shadow" ng-repeat="socialNetwork in networks">' +
            '<div class="social-media-content-header">'+
             '<div class="social-media-content-header-x center">'+
                            '<i class="fa fa-{{socialNetwork.icon}}"></i><br />'+
                            '{{socialNetwork.name}}'+
                        '</div>'+
                        '</div>'+
                        '<div class="social-media-content-body">'+
                    '<div class="social-media-content-body-entry box-shadow" ng-repeat="entry in socialNetwork.feed">'+
                    '<div class="social-media-content-body-entry-image">'+
                    '<div class="center" style="font-size:7vh;"><i class="fa fa-picture-o"></i></div>'+
                    '</div>'+
                    '<div class="social-media-content-body-entry-text">'+
                    '<span>{{entry.text}}</span>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'
            //templateUrl: 'NetworkTemplate.html'
        };
    });