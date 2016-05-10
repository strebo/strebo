app.service('DataService', ['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {

    /* Private Properties */
    var feedByNetwork = [];
    var feed = [];
    var networks = [];
    var mode = ['getPublicFeed', 'getPrivateFeed', 'search'];
    var currentMode = 0;
    var currentLocation = 0;

    $rootScope.locations = [
        {name: "Worldwide", abbreviation: "W"},
        {name: "USA", abbreviation: "US"},
        {name: "Germany", abbreviation: "DE"}
    ];

    conn.onopen = function () {
        conn.send('Ping'); // Send the message 'Ping' to the server
        updateData();
    };

    conn.onerror = function () {
        $rootScope.loaderview = false;
        $rootScope.serverError = true;
        $rootScope.$apply();
    };

    conn.onmessage = function (e) {

        var message = JSON.parse(e.data);

        //console.log(message);

        if (message.type === "data") {
            //console.log(message.json["Instagram"].feed[0].text);
            feedByNetwork = message.json;
            feed.splice(0, feed.length);
            extractPosts();
            feed = shuffle(feed);
            networks.splice(0, networks.length);
            extractNetworks();
            $rootScope.loaderview = false;
            $rootScope.$apply();
        } else if (message.type === "message") {
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
                    text: feedByNetwork[i].feed[j].text || "",
                    title: feedByNetwork[i].feed[j].title,
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
                status: 'disconnected',
                connect: connectors[feedByNetwork[i].name.toLowerCase()] ? connectors[feedByNetwork[i].name.toLowerCase()].connect : null
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

    this.getLocation = function (index) {
        return currentLocation;
    };

    this.getMode = function (index) {
        return currentMode;
    };

    this.setMode = function (index) {
        currentMode = index;
        updateData();
    };

    this.setLocation = function (index) {
        currentLocation = index;
        updateData();
    };

    function updateData() {
        $rootScope.loaderview = true;
        conn.send(JSON.stringify({
            command: mode[currentMode],
            param: $rootScope.locations[currentLocation].abbreviation,
            query: angular.element("#searchview-query").val()
        }));
    }
}]);
