module.exports = function (app, passport) {

    // =======================================
    // TWITTER ROUTES ========================
    // =======================================
    // route for twitter authentication and login
    app.post('/auth/twitter', passport.authenticate('twitter-token'), function (req, res) {
        // do something with req.user
        res.send(req.user ? 200 : 401);
    });

    // =======================================
    // INSTAGRAM ROUTES ======================
    // =======================================
    // route for instagram authentication and login
    app.get('/auth/instagram', passport.authenticate('instagram'));

    // =======================================
    // SOUNDCLOUD ROUTES =====================
    // =======================================
    // route for soundcloud authentication and login
    app.get('/auth/soundcloud', passport.authenticate('soundcloud'));

    // =======================================
    // YOUTUBE ROUTES ========================
    // =======================================
    // route for youtube authentication and login
    app.get('/auth/youtube', passport.authenticate('youtube'));

    // =======================================
    // FACEBOOK ROUTES =======================
    // =======================================
    // route for facebook authentication and login
    app.post('/auth/facebook', passport.authenticate('facebook-token'), function (req, res) {
        // do something with req.user
        res.send(req.user ? 200 : 401);
    });
};