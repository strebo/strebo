// config/passport.js
var TwitterTokenStrategy = require('passport-twitter-token').Strategy;
var InstagramStrategy = require('passport-instagram').Strategy;
var SoundCloudStrategy = require('passport-soundcloud').Strategy;
var YoutubeV3Strategy = require('passport-youtube-v3').Strategy;
var FacebookTokenStrategy = require('passport-facebook-token').Strategy;

// load the auth variables
var configAuth = require('./auth');

module.exports = function (passport) {

    // used to serialize the user for the session
    passport.serializeUser(function (user, done) {
        //console.log(user);
        done(null, user.id);
    });

    // used to deserialize the user
    passport.deserializeUser(function (/*id, done*/) {
        //console.log(id);
    });

    // code for login (use('local-login', new LocalStategy))
    // code for signup (use('local-signup', new LocalStategy))
    // code for facebook (use('facebook', new FacebookStrategy))

    // =========================================================================
    // TWITTER =================================================================
    // =========================================================================
    passport.use(new TwitterTokenStrategy({

            consumerKey: configAuth.twitterAuth.consumerKey,
            consumerSecret: configAuth.twitterAuth.consumerSecret

        },
        function (/*token, tokenSecret, profile, done*/) {

            //console.log(profile);

        }));

    // =========================================================================
    // INSTAGRAM ===============================================================
    // =========================================================================
    passport.use(new InstagramStrategy({

            clientID: configAuth.instagramAuth.clientID,
            clientSecret: configAuth.instagramAuth.clientSecret,
            callbackURL: configAuth.instagramAuth.callbackURL

        },
        function (/*token, tokenSecret, profile, done*/) {

            //console.log(profile);

        }));

    // =========================================================================
    // SOUNDCLOUD ==============================================================
    // =========================================================================
    passport.use(new SoundCloudStrategy({

            clientID: configAuth.soundcloudAuth.clientID,
            clientSecret: configAuth.soundcloudAuth.clientSecret,
            callbackURL: configAuth.soundcloudAuth.callbackURL

        },
        function (/*token, tokenSecret, profile, done*/) {

            //console.log(profile);

        }));

    // =========================================================================
    // YOUTUBE =================================================================
    // =========================================================================
    passport.use(new YoutubeV3Strategy({

            clientID: configAuth.youtubeAuth.clientID,
            clientSecret: configAuth.youtubeAuth.clientSecret,
            callbackURL: configAuth.youtubeAuth.callbackURL,
            scope: ['https://www.googleapis.com/auth/youtube.readonly']

        },
        function (/*token, tokenSecret, profile, done*/) {

            //console.log(profile);

        }));

    // =========================================================================
    // FACEBOOK ================================================================
    // =========================================================================
    passport.use(new FacebookTokenStrategy({

            clientID: configAuth.facebookAuth.clientID,
            clientSecret: configAuth.facebookAuth.clientSecret
        },
        function (/*accessToken, refreshToken, profile, done*/) {

            /* User.findOrCreate({facebookId: profile.id}, function (error, user) {
             return done(error, user);
             });*/

        }));

};