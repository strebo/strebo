app.controller('FeedController', ['$scope', 'DataService', function($scope, DataService) {
    $scope.image = "image";
    $scope.video = "video";
    $scope.youtube = "https://youtu.be/gHonBC3naj4";
    $scope.feed = DataService.getPosts();
    console.log($scope.feed);
    }])
    .directive('feedView', function() {
        return {
            restrict: 'E',
            template: '<div class="social-media-content-container-feed box-shadow" ng-repeat="post in' +
            ' feed">' +
            '<div class="social-media-content-header-feed">'+
                '<div class="social-media-content-title-feed"><img src="{{post.authorPicture}}" style="width:5vh;height:5vh;"> {{post.author}}</div>'+
             '<div class="social-media-content-header-x-feed box-shadow"  style="background-color:{{post.socialNetwork.color}};">'+
                            '<i class="fa fa-{{post.socialNetwork.icon}} center"></i>'+
                        '</div>'+
                '<div class="social-media-content-header-x-triangle-feed"></div>'+
                        '</div>'+
                        '<div class="social-media-content-body-feed">'+
        '<div class="social-media-content-body-entry-image-feed">'+
            '<div class="center" style="font-size:7vh;">'+
            '<img ng-if="post.type === image" src="{{post.media}}" style="max-height:9vw; max-width:13vw;" />'+
            '<video ng-if="post.type === video" controls style="max-height:9vw; max-width:13vw;"><source ng-src="{{youtube}}"></source></video>'+
            '</div>'+
        '</div>'+
                    '<div class="social-media-content-body-entry-text-feed" style="overflow:hidden;"><div class="center" style="width:13vw; height:3vw; overflow:hidden;">{{post.text}}<br/>Likes: {{post.numberOfLikes}}</div></div></div>'+
                    '</div>'
            //templateUrl: 'FeedView.html'
        };
    });