// config/auth.js

// expose our config directly to our application using module.exports
module.exports = {

    'facebookAuth' : {
        'clientID'      : 'your-secret-clientID-here', // your App ID
        'clientSecret'  : 'your-client-secret-here', // your App Secret
        'callbackURL'   : 'http://localhost:8081/auth/facebook/callback'
    },

    'twitterAuth' : {
        'consumerKey'       : 'BspGfBzzXbBKtdWpl0eL1cihi',
        'consumerSecret'    : 'I3ht3hDmG0vY2uTb32WaupyKQq7Rv0htaGW8x2DDhd5ExrNij9',
        'callbackURL'       : 'http://localhost?Twitter=1'
    },

    'googleAuth' : {
        'clientID'      : 'your-secret-clientID-here',
        'clientSecret'  : 'your-client-secret-here',
        'callbackURL'   : 'http://localhost:8081/auth/google/callback'
    }
	
	'instagramAuth' : {
        'clientID'      : 'c12bbe37871f443ca257ef54a131a777',
        'clientSecret'  : '036f0eeacf054448a7c31e58860e453e',
        'callbackURL'   : 'http://localhost:8081/auth/instagram/callback'
    }
	
	'soundcloudAuth' : {
        'clientID'      : 'b44373de55ef0a0048ff5de51c143db6',
        'clientSecret'  : '9b305fb370cf50d4a8d63d745c894d44',
        'callbackURL'   : 'http://localhost:8081/auth/soundcloud/callback'
    }

};