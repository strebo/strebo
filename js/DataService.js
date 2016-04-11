app.service('DataService', ['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {

    /* Private Properties */
    var feedByNetwork = [];
    var feed = [];
    var networks = [];

    var conn = new WebSocket('ws://localhost:8080/echobot');
	
	var data;
	
	conn.onopen = function () {
	data = conn.send(JSON.stringify({command : 'getPublicFeed', param : 'W'}));
	
	};
    
	conn.onmessage = function(e) {
		
		var message=JSON.parse(e.data);
		
		if(message.type=="data") {
				feedByNetwork =message.json;
        extractPosts();
        feed = shuffle(feed);
        extractNetworks();
		$rootScope.$apply();
		}
		if(message.type=="message"){
			console.log(message.message);
		}
   
    };

    // Public method
    this.getNetworks = function () {
        return networks;
    };

    this.getPostsByNetwork = function () {
	   return feedByNetwork;
    };

    this.getPosts = function () {
        return feed;
    };

    /* Private Functions */

    function extractPosts() {
        for (var i in feedByNetwork) {
            for (var j in feedByNetwork[i].feed) {
				feed.push({
                    socialNetwork: {
                        name: feedByNetwork[i].name,
                        icon: feedByNetwork[i].icon,
                        color: feedByNetwork[i].color
                    },
                    text: feedByNetwork[i].feed[j].text,
                    author: feedByNetwork[i].feed[j].author,
                    authorPicture: feedByNetwork[i].feed[j].authorPicture,
                    link: feedByNetwork[i].feed[j].link,
                    type: feedByNetwork[i].feed[j].type,
                    tags: feedByNetwork[i].feed[j].tags,
                    createdTime: feedByNetwork[i].feed[j].createdTime,
                    numberOfLikes: feedByNetwork[i].feed[j].numberOfLikes,
                    media: feedByNetwork[i].feed[j].media,
                    thumb: feedByNetwork[i].feed[j].thumb
                });
				
            }
        }
    }

    function extractNetworks() {
        for (var i in feedByNetwork) {
            networks.push({
                name: feedByNetwork[i].name,
                icon: feedByNetwork[i].icon,
                color: feedByNetwork[i].color,
                status: 'disconnected'
            });
        }
    }

    function shuffle(array) {
        var currentIndex = array.length, temporaryValue, randomIndex;
        while (0 !== currentIndex) {
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }
        return array;
    }
}]);
