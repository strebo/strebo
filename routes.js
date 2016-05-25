module.exports = function (app, passport) {

    // =======================================
    // TWITTER ROUTES ========================
    // =======================================
    // route for twitter authentication and login
    app.get('/auth/twitter', passport.authenticate('twitter'));

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
    app.get('/auth/facebook', passport.authenticate('facebook', {
        authType: 'rerequest',
        scope: ['user_friends', 'manage_pages', 'user_posts', 'user_likes']
    }));
};
