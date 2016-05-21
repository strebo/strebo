function redirectTo(a) {
    window.location.href = 'http://' + location.hostname + ':443/auth/'+a;
}

function getDefaultConfig(name, path, url, tokens) {
    return {
        name: name,
        connect: function() {
            redirectTo(path);
        },
        success: function() {
            if(Url.get[url]) {
                var ltokens = [];
                for(var i in tokens) {
                    if(!Url.get[tokens[i]]) return;
                    ltokens.push(Url.get[tokens[i]]);
                }
                console.debug(name + " is connected.");
                conn.secureSend(JSON.stringify({
                    command: "connect",
                    network: name,
                    tokens: ltokens
                }));
                return;
            }
        }
    };
}

var connectors = {
    youtube: {
        name: "YouTube",
        connect: function () {
            handleAuthResult(null, function (token) {
                    conn.secureSend(JSON.stringify({
                        command: "connect",
                        network: "YouTube",
                        tokens: [token]
                    }));
                }
            );
        }
    }
};

connectors.twitter = getDefaultConfig("Twitter", "twitter", "Twitter", ["oauth_token", "oauth_verifier"]);
connectors.instagram = getDefaultConfig("Instagram", "instagram", "Instagram", ["code"]);
connectors.soundcloud = getDefaultConfig("SoundCloud", "soundcloud", "SoundCloud", ["code"]);

function checkConnections() {
    for(var c in connectors) {
        if(connectors.hasOwnProperty(c)) connectors[c].success && connectors[c].success();
    }
}