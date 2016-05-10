// config/passport.js
var TwitterStrategy  = require('passport-twitter').Strategy;
var InstagramStrategy = require('passport-instagram').Strategy;
var SoundCloudStrategy = require('passport-soundcloud').Strategy;

// load the auth variables
var configAuth = require('./auth');

module.exports = function(passport) {

    // used to serialize the user for the session
    passport.serializeUser(function(user, done) {
        console.log(user);
        done(null, user.id);
    });

    // used to deserialize the user
    passport.deserializeUser(function(id, done) {
       console.log(id);
    });

    // code for login (use('local-login', new LocalStategy))
    // code for signup (use('local-signup', new LocalStategy))
    // code for facebook (use('facebook', new FacebookStrategy))

    // =========================================================================
    // TWITTER =================================================================
    // =========================================================================
    passport.use(new TwitterStrategy({

            consumerKey     : configAuth.twitterAuth.consumerKey,
            consumerSecret  : configAuth.twitterAuth.consumerSecret,
            callbackURL     : configAuth.twitterAuth.callbackURL

        },
        function(token, tokenSecret, profile, done) {

            console.log(profile);

        }));
		
	// =========================================================================
    // INSTAGRAM ===============================================================
    // =========================================================================
    passport.use(new InstagramStrategy({

            consumerKey     : configAuth.instagramAuth.consumerKey,
            consumerSecret  : configAuth.instagramAuth.consumerSecret,
            callbackURL     : configAuth.instagramAuth.callbackURL

        },
        function(token, tokenSecret, profile, done) {

            console.log(profile);

        }));
		
	// =========================================================================
    // SOUNDCLOUD ==============================================================
    // =========================================================================
    passport.use(new SoundCloudStrategy({

            consumerKey     : configAuth.soundcloudAuth.consumerKey,
            consumerSecret  : configAuth.soundcloudAuth.consumerSecret,
            callbackURL     : configAuth.soundcloudAuth.callbackURL

        },
        function(token, tokenSecret, profile, done) {

            console.log(profile);

        }));

};

