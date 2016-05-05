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

};