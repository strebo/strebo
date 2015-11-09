app.controller('FeedController', ['$scope', function($scope) {

    function shuffle(array) {
        var currentIndex = array.length, temporaryValue, randomIndex ;
        while (0 !== currentIndex) {
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }
        return array;
    }

        var networks = [{
            name: 'YouTube',
            icon: 'youtube',
            color: '#e52d27',
            feed: [{
                text: "Cool Vid!"
            }]
        },{
            name: 'Twitter',
            icon: 'twitter',
            color: '#4099FF',
            feed: [{
                text: "Hallo Welt!"
            }, {
                text: "From Twitter!"
            }]
        }, {
            name: 'Facebook',
            icon: 'facebook',
            color: '#3B5998',
            feed: [{
                text: "Hallo Welt!"
            }, {
                text: "#Hashtag"
            }, {
                text: "From Facebook!"
            }]
        }];

        var feed = [];
    
        for(var i in networks) {
            for(var j in networks[i].feed) {
                feed.push({
                    socialNetwork: {
                        name: networks[i].name,
                        icon: networks[i].icon,
                        color: networks[i].color
                    },
                    text: networks[i].feed[j].text
                });
            }
        }

    $scope.feed = shuffle(feed);
    
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