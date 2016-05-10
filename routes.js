module.exports = function(app, passport) {

    // =====================================
    // TWITTER ROUTES ======================
    // =====================================
    // route for twitter authentication and login
    app.get('/auth/twitter', passport.authenticate('twitter'));
	
	// =====================================
    // INSTAGRAM ROUTES ======================
    // =====================================
    // route for twitter authentication and login
    app.get('/auth/instagram', passport.authenticate('instagram'));
	
	// =====================================
    // SOUNDCLOUD ROUTES ======================
    // =====================================
    // route for twitter authentication and login
    app.get('/auth/soundcloud', passport.authenticate('soundcloud'));
};