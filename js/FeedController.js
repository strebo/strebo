app.controller('FeedController', ['$scope', 'DataService', function($scope, DataService) {
    $scope.feed = DataService.getPosts();
    }])
    .directive('feedView', function() {
        return {
            restrict: 'E',
            template: '<div class="social-media-content-container-feed box-shadow" ng-repeat="post in' +
            ' feed">' +
            '<div class="social-media-content-header-feed">'+
                '<div class="social-media-content-title-feed">Autor des Beitrags</div>'+
             '<div class="social-media-content-header-x-feed box-shadow"  style="background-color:{{post.socialNetwork.color}};">'+
                            '<i class="fa fa-{{post.socialNetwork.icon}} center"></i>'+
                        '</div>'+
                '<div class="social-media-content-header-x-triangle-feed"></div>'+
                        '</div>'+
                        '<div class="social-media-content-body-feed">'+
        '<div class="social-media-content-body-entry-image-feed">'+
            '<div class="center" style="font-size:7vh;"><i class="fa fa-picture-o"></i></div>'+
        '</div>'+
                    '<div class="social-media-content-body-entry-text-feed"><div class="center">{{post.text}}</div></div></div>'+
                    '</div>'
            //templateUrl: 'FeedView.html'
        };
    });