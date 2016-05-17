var Url = {
    get get() {
        var vars = {};
        if (window.location.search.length !== 0)
            window.location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
                key = decodeURIComponent(key);
                if (typeof vars[key] === "undefined") {
                    vars[key] = decodeURIComponent(value);
                }
                else {
                    vars[key] = [].concat(vars[key], decodeURIComponent(value));
                }
            });
        return vars;
    }
};

var connectors = {
    twitter: {
        name: "Twitter",
        connect: function () {
            redirectTo('twitter');
        },
        success: function () {
            if (Url.get.Twitter && Url.get.oauth_token && Url.get.oauth_verifier) {
                conn.send(JSON.stringify({
                    command: "connect",
                    network: "Twitter",
                    tokens: [Url.get.oauth_token, Url.get.oauth_verifier]
                }));
            console.log("SoundCloud connected");
        } else {
            console.log("SoundCloud not connected");
}
        }
    }, youtube: {
        name: "YouTube",
        connect: function () {
            handleAuthResult(null, function (token) {
                    conn.send(JSON.stringify({
                        command: "connect",
                        network: "YouTube",
                        tokens: [token]
                    }));
                console.log("YouTube connected");
                }
            );
        }
    }, instagram: {
        name: "Instagram",
        connect: function () {
            redirectTo('instagram');
        },
        success: function () {
            if (Url.get.Instagram && Url.get.code) {
                conn.send(JSON.stringify({
                    command: "connect",
                    network: "Instagram",
                    tokens: [Url.get.code]
                }));
                console.log("Instagram connected");
            } else {
                console.log("Instagram not connected");
            }
        }
    }, soundcloud: {
        name: "SoundCloud",
        connect: function () {
            redirectTo('soundcloud');
        },
        success: function () {
            if (Url.get.SoundCloud && Url.get.code) {
                conn.send(JSON.stringify({
                    command: "connect",
                    network: "SoundCloud",
                    tokens: [Url.get.code]
                }));
                console.log("SoundCloud connected");
            } else {
                console.log("SoundCloud not connected");
            }
        }
    }
};

connectors.twitter.success();
connectors.instagram.success();
connectors.soundcloud.success();

function redirectTo(a) {
    window.location.href = 'http://' + location.hostname + ':443/auth/'+a;
}
