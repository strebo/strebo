app.service('DataService', function () {

    /* Private Properties */
    var feedByNetwork = [];
    var feed = [];
    var networks = [];

    feedByNetwork = [{
        name: 'YouTube',
        icon: 'youtube',
        color: '#e52d27',
        feed: [{
            text: "Cool Vid!"
        }]
    }, {
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

    extractPosts();
    feed = shuffle(feed);

    extractNetworks();

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
                    text: feedByNetwork[i].feed[j].text
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
});
